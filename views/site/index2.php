<!DOCTYPE html>

<html>
    <head>
        <title>Test180</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <form action="/api/url/add" class="form-url" data-url=".form-url-input" data-msg=".form-msg" data-info=".form-info">
            <h2>форма Input</h2>
            <label>
                <span>поле URL</span>
                <input type="url" name="href" required class="form-url-input" placeholder="URL">
            </label>
            <label>
                <span>кнопка "отправить"</span>
                <input type="submit" value="&rarr;">
            </label>
            <div class="form-msg" data-ok="успех" data-error="URL недоступен" data-pending="в прроцессе" data-clear=""></div>
            <ul class="form-info nod" data-url=".form-info-url" data-qr=".form-info-qr">
                <li>
                    <p class="form-info-url">
                </li>
                <li>
                    <img class="form-info-qr" alt="img">
                </li>
            </ul>
        </form>
    </body>
</html>
<script src="/js/script.js"></script>