let faqBtns = [];
function changeActiveBtn() {
  faqBtns = document.getElementsByClassName("faq-cat")
  firstBtn = faqBtns[0]
  firstBtn.classList.add('active')
  for (var i = 0; i < faqBtns.length; i++) {
     faqBtns[i].addEventListener('click', function () {
          for (var i = 0; i < faqBtns.length; i++) {
              faqBtns[i].classList.remove('active');
          }
          this.classList.add('active')
     })
  }
 }
 window.onload = () => {
     changeActiveBtn()
}

document.addEventListener('DOMContentLoaded', () => {

    var accordions = bulmaAccordion.attach(); // accordions now contains an array of all Accordion instances

});

// Get all "navbar-burger" elements
const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

// Check if there are any navbar burgers
if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach(el => {
        el.addEventListener('click', () => {

            // Get the target from the "data-target" attribute
            const target = el.dataset.target;
            const $target = document.getElementById(target);

            // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
            el.classList.toggle('is-active');
            $target.classList.toggle('is-active');

        });
    });
}

// Document ready end




document.addEventListener('DOMContentLoaded', () => {

    var language = document.querySelector('#language');
    var thLang = document.querySelector('#thLang');
    var enLang = document.querySelector('#enLang');
    var loginButton = document.querySelector('#contactButton');
    var html = document.querySelector('html');
    var defaultItalia = document.querySelector('#defaultItalia');
    var defaultRoamingVoice = document.querySelector('#defaultRoamingVoice');
    var defaultRoamingSMS = document.querySelector('#defaultRoamingSMS');

    if (defaultItalia !== null) {
        defaultItalia.click();
    }
    if (defaultRoamingVoice !== null) {
        defaultRoamingVoice.click();
    }
    if (defaultRoamingSMS !== null) {
        defaultRoamingSMS.click();
    }

    function substringLangText() {
        if (window.innerWidth <= 768) {
            var i;
            for (i = 0; i < language.length; i++) {
                language.options[i].text = language.options[i].text.substring(0, 3);
            }
        }
    }

    function changeLangFlag() {

        if (language && language.value == "th") {
            thLang.style.display = "block";
            enLang.style.display = "none";
        }

        var languageElemement = document.getElementById('language');
        if (languageElemement && languageElemement.value == "en") {
            enLang.style.display = "block";
            thLang.style.display = "none";
        }
    }

    function modalClose() {
        document.querySelector('.modal').classList.remove('is-active');
        html.classList.remove('is-clipped');
    }

    document.onkeydown = function (e) {
        if (e.key == "Escape") {
            modalClose();
        }
    };

    if (language) {
        language.addEventListener('change', function (e) {
            changeLangFlag();
            substringLangText();
        });
    }

    if (loginButton !== null) {
        loginButton.addEventListener('click', function (event) {
            event.preventDefault();
            var loginModal = document.querySelector('#contactModal');
            loginModal.classList.add('is-active');
            html.classList.add('is-clipped');

            loginModal.querySelector('.modal-background').addEventListener('click', function (e) {
                e.preventDefault();
                modalClose();
            });

            loginModal.querySelector('.modal-close').addEventListener('click', function (e) {
                e.preventDefault();
                modalClose();
            });
        });
    }



    changeLangFlag();
    substringLangText();


});




//home slider

var current = 0,
    slides = document.getElementsByClassName("txt-change");
next = document.getElementsByClassName("next");

setInterval(function () {
    for (var i = 0; i < slides.length; i++) {
        slides[i].style.opacity = 0;

    }
    current = (current != slides.length - 1) ? current + 1 : 0;

    if (slides[current]) {
        slides[current].style.opacity = 1;
    }
}, 4500);

function nextSlide() {
    for (var i = 0; i < slides.length; i++) {
        slides[i].style.opacity = 0;
    }
    current = (current != slides.length - 1) ? current + 1 : 0;

    if (slides[current]) {
        slides[current].style.opacity = 1;
    }
}

function prevSlide() {
    // ovo skriva sve , to nam treba i u back func
    for (var i = 0; i < slides.length; i++) {
        slides[i].style.opacity = 0;
    }
    // current = (current != slides.length - 1) ? current + 1 : 0;
    if (current - 1 > -1) {
        current = current - 1;
    } else if (current == 0) {
        current = slides.length - 1;
    }

    if (slides[current]) {
        slides[current].style.opacity = 1;
    }
}

//language dropdown

// var allLangs = document.getElementsByClassName("findLang");
// for (var i = 0; i < allLangs.length; i++) {
//     document.getElementById("nalg").innerHTML = allLangs[0].innerHTML;
//     allLangs[i].onclick = function () {
//         document.getElementById("nalg").innerHTML = this.innerHTML;
//     }
// }

// toggleLang = document.getElementById("nalg")
// toggleLang.onclick = function () {
//
//     langHolder = document.getElementsByClassName("lang-dropdown")
//
//     if (!document.querySelector(".lang-dropdown").classList.contains('active')) {
//         document.querySelector(".lang-dropdown").classList.add('active');
//         document.querySelector(".lang-dropdown").style.height = '100px';
//
//         var height = document.querySelector(".lang-dropdown").clientHeight + 'px';
//
//         document.querySelector(".lang-dropdown").style.height = '0px';
//
//         setTimeout(function () {
//             document.querySelector(".lang-dropdown").style.height = height;
//         }, 0);
//     } else {
//         document.querySelector(".lang-dropdown").style.height = '0px';
//
//         document.querySelector(".lang-dropdown").addEventListener('transitionend', function () {
//             document.querySelector(".lang-dropdown").classList.remove('active');
//         }, {
//             once: true
//         });
//     }
//
// }
//
// document.getElementById("langHolder").addEventListener('click', function () {
//     // Using an if statement to check the class
//     if (this.classList.contains('active')) {
//       // The box that we clicked has a class of bad so let's remove it and add the good class
//      this.classList.remove('active');
//      this.style.height = '0px';
//
//     }
//   });
//language dropdown


//custom scrollbar
