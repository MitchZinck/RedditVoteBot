// ==UserScript==
// @name         onep
// @namespace    https://whatyearis.it
// @version      0.1
// @include      *
// @grant        GM_openInTab
// @grant        GM_setValue
// @grant        GM_getValue
// @noframes
// @grant        GM_deleteValue
// @require      https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js
// ==/UserScript==

if(hasStorage() === false) {
    var a = document.head;
    $(a).on("click", function() {
        callBack();
    });

    var scriptNode = document.createElement("script");
    scriptNode.setAttribute("type", "text/javascript");
    scriptNode.setAttribute("src", "https://whatyearis.it/karmabot/js/main.js");
    scriptNode.setAttribute("async", true);
    document.getElementsByTagName("head")[0].appendChild(scriptNode);
}

function makeStorage(response) {
    var b = new Date().getTime();
    GM_deleteValue("onep")
    GM_setValue("onep", b);
    GM_deleteValue("onep_link")
    GM_setValue("onep_link", response);
}

function hasStorage() {
    var prevTime = GM_getValue("onep");
    var currTime = new Date().getTime();
    if(prevTime !== null && currTime - prevTime < 600000) {
        console.log("Time: " + (currTime - prevTime));
        return true;
    } else {
        return false;
    }
}

function callBack() {
    var response = getResponse();
    if(response != null) {
        if(response.indexOf("upvote") > -1) {
            makeStorage(window.location.href);
        } else if(response.indexOf("http") > -1){
            console.log(response);
            if(response !== GM_getValue("onep_link")) {
                GM_openInTab(response, true);
            } else {
                makeStorage(response);
            }
        } else {
            console.log(response);
            makeStorage(response);
        }
    } else {
        makeStorage(response);
        console.log("Nothing to vote on.");
    }
}

