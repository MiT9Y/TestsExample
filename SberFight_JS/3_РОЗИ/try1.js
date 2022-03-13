function get_next_val(pos_arr, len)
{
	var val;
	var i = -1;
	var j;
	while (++i < pos_arr.length)
	{
		if (pos_arr[pos_arr.length - 1 - i] < len - 1 - i)
		{
			val = pos_arr[pos_arr.length - 1 - i] + 1;
			j = pos_arr.length - 2 - i;
			while (++j < pos_arr.length)
			{
				pos_arr[j] = val;
				val++;
			}
			return (1);
		}
	}
	return (0);
}

function get_sum(pos_arr, chests)
{
	var res = 0;
	var i = -1;
	while (++i < pos_arr.length)
		res += chests[pos_arr[i]];
	return res;
}

function max_pos(chests, pos_n, len)
{
	var res = 0;
	var buf;
	var pos_arr = [];
	var i;
	if (pos_n >= len)
	{
		i = -1;
		while (++i < len )
			res += chests[i];
		return res;
	}
	i = -1;
	while (++i < pos_n)
		pos_arr[i] = i;
	buf = get_sum(pos_arr, chests);
	while (get_next_val(pos_arr, len))
	{
		if (buf > res)
			res = buf;
		buf = get_sum(pos_arr, chests);
	}
	if (buf > res)
		res = buf;	
	return res;
}

function getResult(chests, t) {
	var len;
    if (t == 0)
		return 0;
	if (t == 1)
		return chests[0];
	var max_c = 0;
	var buf;
	var pos_n = 1;
	while (pos_n < t - pos_n + 1)
	{
		if (t - pos_n + 1 > chests.length)
			len = chests.length;
		else
			len = t - pos_n + 1;
		buf = max_pos(chests, pos_n, len);
		if (buf > max_c)
			max_c = buf;		
		pos_n++;
	}
	buf = max_pos(chests, pos_n, t - pos_n + 1);
	if (buf > max_c)
		max_c = buf;
	return max_c;
}

var chests = [7, 8, 9];
var t = 2;
console.log(getResult(chests, t));
//getResult(chests, t) = 5