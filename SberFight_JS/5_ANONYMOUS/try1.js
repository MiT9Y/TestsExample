function check_arr(arr)
{
	var i = 0;
	while (true)
	{
		if (i == arr.length - 1)
			return (true);
		if (arr[i] == -100 || i >= arr.length || i < 0)
			return (false);
		else
		{
			var buf = arr[i];
			arr[i] = -100;
			i += buf;
		}
	}
}

function getResult(fences) {
	var res = false;

	function permute(arr, memo) {
		var cur;
		var memo = memo || [];
		for (var i = 0; i < arr.length; i++) {
		  	cur = arr.splice(i, 1);
		  	if (arr.length === 0) {
				if (check_arr((memo.concat(cur)).slice()))
					res = true;
			}
			if (res)
				return;
			permute(arr.slice(), memo.concat(cur));
			arr.splice(i, 0, cur[0]);
		}
		return;
	}
	permute(fences);
	return (res);
}

var fences = [-2,-1,0,0,1,3,4];
console.log(getResult(fences));
