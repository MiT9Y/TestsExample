function get_type(arr, i, j)
{
	var l = 0;
	var r = 0;
	var u = 0;
	var d = 0;
	if (j == 0)
		l = 1;
	else if (arr[i][j - 1] == '1')
		l = 1;
	if (j == arr[i].length - '1')
		r = 1;
	else if (arr[i][j + 1] == '1')
		r = 1;
	if (i == 0)
		u = 1;
	else if (arr[i - 1][j] == '1')
		u = 1;
	if (i == arr.length - '1')
		d = 1;
	else if (arr[i + 1][j] == '1')
		d = 1;
	if (u == 0 && d == 1 && l == 0 && r == 1)
		return(0);
	if (u == 0 && d == 1 && l == 1 && r == 1)
		return(1);
	if (u == 0 && d == 1 && l == 1 && r == 0)
		return(2);
	if (u == 1 && d == 1 && l == 0 && r == 1)
		return(3);
	if (u == 1 && d == 1 && l == 1 && r == 1)
		return(4);
	if (u == 1 && d == 1 && l == 1 && r == 0)
		return(5);
	if (u == 1 && d == 0 && l == 0 && r == 1)
		return(6);
	if (u == 1 && d == 0 && l == 1 && r == 1)
		return(7);
	if (u == 1 && d == 0 && l == 1 && r == 0)
		return(8);
	if (u == 1 && d == 1 && l == 0 && r == 0)
		return(9);
	if (u == 0 && d == 0 && l == 1 && r == 1)
		return(10);
	return(-1);
}

function getResult(scheme) {
	var type = [17,32,10,40,63,31,15,29,13,20,21];
	var arr = [];
	var res = 0;
	var idx;

	for (var i = 0; i < scheme.length; i++) {
		arr.push(scheme[i].split('-'));
	}
	for (var i = 0; i < arr.length; i++) {
		for (var j = 0; j < arr[i].length; j++) {
			if (arr[i][j] == '1')
			{
				idx = get_type(arr, i, j);
				if (idx > -1)
					res += type[idx];
			}
		}
	}
	return(res);
}

var scheme = [
	'0-0-0-0',
	'1-1-1-0',
	'0-0-1-0',
	'0-0-1-0'];
	
console.log(getResult(scheme));