function get_arr(treasures)
{
	var res = [];
	var i = -1;

	while(++i < treasures.length)
		res.push({val: treasures[i], act: -1});
	return (res);
}

function get_max_idx(arr)
{
	var i = -1;
	var val = 0;
	var res = -1;

	while(++i < arr.length)
	{
		if (arr[i].act == -1 && val < arr[i].val)
		{
			val = arr[i].val;
			res = i;
		}
	}
	return (res);
}

function get_sum(arr, j, act)
{
	var res = 0;

	if (act)
	{
		if ((j > 0 && (arr[j - 1].act == -1 || arr[j - 1].act == 0)) || j == 0)
			res += arr[j];
		else
			res += arr[j] / 2;
		res += arr[j + 1] / 2;
	}
	else
	{
		res = arr[j + 1] * 1.0;
	}
	return (res);
}

function getResult(treasures)
{
	var arr = get_arr(treasures);
	var i;
	var j;
	var res = 0.0;

    if (treasures.length == 0)
		return (0);
	if (treasures.length == 1)
		return (treasures[0]);
	while ((i = get_max_idx(arr)) != -1)
	{
		arr[i].act = 1;
		j = i;
		while (--j > -1 && arr[j].act == -1)
		{
			if (get_sum(arr, j, 1) > get_sum(arr, j, 0))
				arr[j].act = 1;
			else
			{
				arr[j].act = 0;
				break;
			}
		}
	}
	i = 0;
	if (arr[0].act)
		res += arr[0].val;
	while (++i < arr.length)
	{
		if (arr[i].act)
		{
			if (arr[i - 1].act)
				res += arr[i].val / 2;
			else
				res += arr[i].val;
		}
	}
	return (Math.ceil(res));
}

var treasures = [3,2,10,100];
console.log(getResult(treasures));