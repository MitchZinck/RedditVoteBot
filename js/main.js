function createCallBack(response) {
    link = response;
    triggerCB();
}

function triggerCB() {
    var body = document.head;
    $(body).trigger("click");
}

function XHR(action, link, params, callback) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if(typeof callback === "function") {
                callback(response);			
            }
        }
    };

    xhr.open(action, link, true);
    if(action === "POST") {
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    }
    xhr.send(params);
}

function getResponse() {
    return link;
}

function checkResponse(response) {
    if(response.indexOf("reddit.com") > -1) {
        if(window.location.href === response) {
            document.title = "UPVOTE THIS POST.";
            XHR("POST", "https://whatyearis.it/karmabot/vote.php", "name=" + getName() + "&link=" + response, null);
            createCallBack("upvote");
        } else {
            createCallBack(response);
        }
    } else {
        console.log(response);
        var name;
        if(window.location.href.indexOf("reddit.com") > -1) {
            name = getName();
        } else {
            name = "noname";
        }
        XHR("POST", "https://whatyearis.it/karmabot/time.php", "name=" + name, null);
        createCallBack("onep_nothing");
    }
}

function getName() {
    var clazz = document.getElementsByClassName("user");
    var name = clazz[0].getElementsByTagName("A")[0].innerHTML;
    return name;
}

function init() {
    if(!window.jQuery) {
        loadJQ();
    } else {
        procede();
    }

}

function loadJQ() {
    var jq = document.createElement('script');
    jq.src = "//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js";
    document.querySelector('head').appendChild(jq);

    jq.onload = procede;    
}

function procede() {
    XHR("GET", "https://whatyearis.it/karmabot/vote.php", null, checkResponse);
}

var link = "";
init();