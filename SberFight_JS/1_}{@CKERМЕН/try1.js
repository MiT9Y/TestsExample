function getResult(time) {
	if (time.length < 2)
		return true;
	var i = -1;
	var b;
	var e;
	while (++i < time.length - 1)
	{
		e = time[i].substr(3, 4) * 1;
		b = time[i + 1].substr(0, 2) * 1;
		if (e > b)
			return false;
	}
	return true;
}

var time = ["09-13", "12-14"];

console.log(getResult(time));