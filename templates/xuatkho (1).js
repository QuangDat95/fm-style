var array1 = new Array();
var array2 = new Array();

function addpro (a,b,c) {
	array1[a] = new Array(a,b,c);

	array2[a] = new Array(a,b,c);
}

function discount_pro (){
	for (const key in array1) {
		if (Object.hasOwnProperty.call(array1, key)) {
			array1[key][1] = 20; 
		}
	}
}

function remove_promo(){
	array1 = array2;
}