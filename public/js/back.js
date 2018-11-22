function countChar(i,x) {
	'use strict';
	var ci = document.getElementsByClassName('count-inpt'),
	    cp = document.getElementsByClassName('count-p');
        cp[i].textContent = x - ci[i].value.length;
        cp[i].style.color = cp[i].textContent < 0 ? '#f00' : '#000' ;

}
/*======================================*/
function toggleNav() {
	'use strict';
	var slide = document.getElementsByTagName('nav');
	slide[0].style.transition = 'all 0.5s ease-in-out';
	slide[0].style.height != '135px' ? slide[0].style.height = '135px' : slide[0].style.height = '0px';
}
/*=====================add-delete-placeholder======================*/
var input = document.getElementsByTagName('input'),
    cond  = "input[i].getAttribute('type') == 'text' || input[i].getAttribute('type') == 'password'",
    i;

for (var i = 0; i < input.length; i++) {
	(function (i) {
		input[i].onfocus = function () {
			if (cond) {
				input[i].setAttribute('data-text',input[i].getAttribute('placeholder'));
	            input[i].setAttribute('placeholder','');
			}
		}
		input[i].onblur = function () {
			if (cond) {
	           input[i].setAttribute('placeholder',input[i].getAttribute('data-text'));
	           input[i].setAttribute('data-text','');
			}
		}
    })(i);
}
/*=====================add-delete-placeholder======================*/
