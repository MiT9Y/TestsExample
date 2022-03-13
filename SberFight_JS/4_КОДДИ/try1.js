function getCount(arr, symbol, i)
{
	while (arr.length > 1)
	{
		if ( ((i - 1 > -1) && arr[i - 1].smb != ' ')
			|| ((i - 1 > -1) && arr[i - 1].smb == ' ' && (i - 2 > -1) && arr[i - 2].count < arr[i].count + arr[i - 1].count) 
			|| (i == 1 && arr[i - 1].smb == ' ') )
		{
			arr[i].count += arr[i - 1].count;
			arr.splice(i - 1, 1);
			i -= 1;
		}
		else if ( ((i + 1 < arr.length) && arr[i + 1].smb != ' ')
			|| ((i + 1 < arr.length) && arr[i + 1].smb == ' ' && (i + 2 < arr.length) && arr[i + 2].count < arr[i].count + arr[i + 1].count) 
			|| (i == arr.length - 2 && arr[i + 1].smb == ' ') )
		{
			arr[i].count += arr[i + 1].count;
			arr.splice(i + 1, 1);
		}
		else
			return(arr[i].count);
	}
	return (arr[i].count);
}

function get_arr(s)
{
	var res = [];
	var smb = ''
	var i = -1;

	while(++i < s.length)
		if (s[i] != smb)
		{
			res.push({smb: s[i], count: 1});
			smb = s[i];
		}
		else
			res[res.length - 1].count += 1;
	return (res);

}

function getResult(s, symbol)
{
	var arr = get_arr(s);
	var res = [];
	var res2 = 0;
	var j = -1;
	while (++j < arr.length)
		if (arr[j].smb == symbol)
			res.push(j);
	if (res.length == 0)
		return (res2);
	j = -1;
	while(++j < res.length)
		res[j] = getCount(arr.slice(), symbol, res[j]);
	j = -1;
	while(++j < res.length)
		if (res[j] > res2)
			res2 = res[j];
	return (res2);

}

var s = "bbbb cc aa bb";
var symbol = "b";
console.log(getResult(s, symbol));