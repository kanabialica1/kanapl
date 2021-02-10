url = document.location.href;

if (url.match(/utm_source=/)) {
    var utm_source = window.location.search.split('utm_source=')[1].split('&')[0];
    addField('utm_source', utm_source);
}
if (url.match(/utm_content=/)) {
    var utm_content = window.location.search.split('utm_content=')[1].split('&')[0];
    addField('utm_content', utm_content);
}
if (url.match(/utm_medium=/)) {
    var utm_medium = window.location.search.split('utm_medium=')[1].split('&')[0];
    addField('utm_medium', utm_medium);
}
if (url.match(/utm_campaign=/)) {
    var utm_campaign = window.location.search.split('utm_campaign=')[1].split('&')[0];
    addField('utm_campaign', utm_campaign);
}
if (url.match(/utm_term=/)) {
    var utm_term = window.location.search.split('utm_term=')[1].split('&')[0];
    addField('utm_term', utm_term);
}
if (url.match(/utm_sub1=/)) {
    var utm_sub1 = window.location.search.split('utm_sub1=')[1].split('&')[0];
    addField('utm_sub1', utm_sub1);
}
if (url.match(/utm_sub2=/)) {
    var utm_sub2 = window.location.search.split('utm_sub2=')[1].split('&')[0];
    addField('utm_sub2', utm_sub2);
}
if (url.match(/utm_sub3=/)) {
    var utm_sub3 = window.location.search.split('utm_sub3=')[1].split('&')[0];
    addField('utm_sub3', utm_sub3);
}
if (url.match(/utm_sub4=/)) {
    var utm_sub4 = window.location.search.split('utm_sub4=')[1].split('&')[0];
    addField('utm_sub4', utm_sub4);
}
if (url.match(/utm_sub5=/)) {
    var utm_sub5 = window.location.search.split('utm_sub5=')[1].split('&')[0];
    addField('utm_sub5', utm_sub5);
}

//Добавление скрытого поля к каждой форме
function addField(name, value) {
    $("form").each(function () {
        $(this).prepend('<input name="' + name + '" style="display: none" type="text" value="' + value + '">');
    });
}

//Перезапись путей action в формах
$("form").each(function () {
    $(this).attr('action', 'Api/send-form.php');
});