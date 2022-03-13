function getResult(passersby) {
	var a1 = passersby.sort(function(a, b) {return a - b;});
	var i = -1;
	var res = 0;
	while (++i < Math.trunc(a1.length / 2))
	{
		res -= a1[i];
	}
	if (!(a1.length % 2))
		i--;
	while (++i < a1.length)
	{
		res += a1[i];
	}
	return (res);
}

var passersby = [0, 3, 10, 4, 8];
console.log(getResult(passersby));