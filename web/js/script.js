(({"document": doc, "location": loc,}, formCssSelector) => doc.addEventListener("DOMContentLoaded", () => {
    const form = doc.querySelector(formCssSelector);
    const formAction = new URL(form.getAttribute("action"), loc.origin);
    const nodeInfo = form.querySelector(form.dataset.info);
    const nodeMsg = form.querySelector(form.dataset.msg);
    const nodeMsgGet = (key, error) => [nodeMsg.dataset[key], error,].filter(data => data?.length).join(": ");
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
                if ("error" in data) throw data.error?.href ?? data.error;

                return data;
            })
            .then(data => {
                nodeInfo.querySelector(nodeInfo.dataset.url).textContent = data.url;
                nodeInfo.querySelector(nodeInfo.dataset.qr).setAttribute("src", data.qr);
                nodeInfo.classList.remove("nod");

                nodeMsgSet("ok");
            })
            .catch(exception => nodeMsgSet("error", exception));
    });
}))(window, ".form-url");