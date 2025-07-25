(({"document": doc, "location": loc,}, formCssSelector) => doc.addEventListener("DOMContentLoaded", () => {
    const form = doc.querySelector(formCssSelector);
    const formAction = new URL(form.getAttribute("action"), loc.origin);
    const nodeUrlInput = form.querySelector(form.dataset.url);
    const nodeInfo = form.querySelector(form.dataset.info);
    const nodeMsg = form.querySelector(form.dataset.msg);
    const nodeMsgGet = (key, error) => [nodeMsg.dataset[key], error,].filter(data => data && String(data).length).join(": ");
    const nodeMsgSet = (key, error) => nodeMsg.textContent = nodeMsgGet(key, error);

    nodeMsg.addEventListener("input", evt => nodeMsgSet("clear"));
    form.addEventListener("submit", evt => {
        evt.preventDefault();

        formAction.search = new URLSearchParams(new FormData(form));

        nodeMsgSet("pending");
        nodeInfo.classList.add("nod");

        fetch(formAction)
            .then(data => data.json())
            .then(data => {
                if (!("error" in data)) return data;
                if ("href" in data.error) throw data.error.href;

                throw data.error;
            })
            .then(data => {
                nodeInfo.querySelector(nodeInfo.dataset.url).textContent = data.url;
                nodeInfo.querySelector(nodeInfo.dataset.qr).setAttribute("src", data.qr);

                nodeMsgSet("ok");
                nodeInfo.classList.remove("nod");
            })
            .catch(exception => {
                nodeMsgSet("error", exception);
            });
    });
}))(window, ".form-url");