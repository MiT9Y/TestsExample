function f_pos(arr, val)
{
	var i = -1;

	while (++i < arr.length)
	if (arr[i] == val)
		return (i);
	return (0);
}

function getResult(arrayStart, arrayGoal) {
	var i = -1;
	var pos;
	var res = 0;
	while (++i < arrayStart.length)
	{
		if (arrayStart[i] != arrayGoal[i])
		{
			arrayStart[f_pos(arrayStart, arrayGoal[i])] = arrayStart[i];
			arrayStart[i] = arrayGoal[i];
			res++;
		}
	}
	return (res);
}

var array_start = [4, 5, 2, 3];
var array_goal = [5, 4, 3, 2];
console.log(getResult(array_start,array_goal));