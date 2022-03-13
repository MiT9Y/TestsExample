function init_rocket(rocketPos, rocketSpeed)
{
	var res = [];
	if (rocketPos.length == rocketSpeed.length)
	return (rocketSpeed.slice());
	for (var i = 0; i < rocketPos.length; i++) {
		if (i < rocketSpeed.length)
			res.push(rocketSpeed[i]);
		else
			res.push(0);
	}
}

function chk_pos_roc(rocketPos, rocketSpeed)
{
	for (var i = 0; i < rocketPos.length - 1; i++) {
		for (var j = i + 1; j < rocketPos.length; j++) {
			if ((rocketPos[i] < rocketPos[j] && rocketSpeed[i] > rocketSpeed[j])
				|| (rocketPos[i] > rocketPos[j] && rocketSpeed[i] < rocketSpeed[j]))
			{
				return (true);
			}
		}
	}
	return (false);
}

function next_step(rocketPos, rocketSpeed)
{
	for (var i = 0; i < rocketPos.length; i++) {
		rocketPos[i] = rocketPos[i] + rocketSpeed[i];
	}
}

function chk_add_rocket(rocketPos, rocketSpeed)
{
	for (var i = 0; i < rocketPos.length - 1; i++) {
		for (var j = i + 1; j < rocketPos.length; j++) {
			if (rocketPos[i] == rocketPos[j])
			{
				rocketSpeed[i] = rocketSpeed[i] + rocketSpeed[j];
				rocketPos.splice(j, 1);
				rocketSpeed.splice(j, 1);
			}
		}
	}
}

function getResult(rocketPos, rocketSpeed) {
	if (rocketPos.length < 2)
		return (rocketPos.length);
	rocketSpeed = init_rocket(rocketPos, rocketSpeed);
	chk_add_rocket(rocketPos, rocketSpeed);
    while (chk_pos_roc(rocketPos, rocketSpeed))
	{
		next_step(rocketPos, rocketSpeed);
		chk_add_rocket(rocketPos, rocketSpeed);
	}
	return (rocketPos.length);
}

var rocket_pos = [2, 3];
var rocket_speed = [1, 2];
console.log(getResult(rocket_pos, rocket_speed));