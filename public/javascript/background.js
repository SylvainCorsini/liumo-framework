var pfx = ["webkit", "moz", "MS", "o", ""];
function PrefixedEvent(element, type, callback) {
    for (var p = 0; p < pfx.length; p++) {
        if (!pfx[p]) type = type.toLowerCase();
        element.addEventListener(pfx[p]+type, callback, false);
    }
}

/* Creates correct prefixes for AnimationEnd eventListener */

function resetanim(elem) {
    elem.style.removeProperty('-moz-animation');
    elem.style.removeProperty('-webkit-animation');
    elem.style.removeProperty('animation');
}

/* resets styles at end of animation so they can be fired again */

window.addEventListener('resize', function() {
    var abovewater = document.querySelector('div.float-wrapper > h1');
    var belowwater = document.querySelector('div#ocean h1');
    var studio = document.querySelector('h2.effra');
    studio.style.fontSize="5vw";
    abovewater.setAttribute("style","-moz-animation: topslosh 2.8s; -webkit-animation: topslosh 2.8s; animation: topslosh 2.8s;");
    belowwater.setAttribute("style","-moz-animation: bottomslosh 2.8s; -webkit-animation: bottomslosh 2.8s; animation: bottomslosh 2.8s" );
    PrefixedEvent(abovewater, "AnimationEnd", function() {
        resetanim(abovewater);
        resetanim(belowwater);
    });
    /* resizes fonts correctly for Webkit; starts animation on browser window resize and resets the animation after it is finished */
});