function getResult(actions) {
    var i = -1;
	var pow = false;
	var key = false;
	var click = false;
	var sum = 0;
	while (++i < actions.length)
	{
		if (actions[i] == 'power')
		{
			pow = true;
			key = false;
			click = false;
		}
		else if (pow && actions[i] == 'keystrokes')
		{			
			key = true;
			click = false;
		}
		else if (key && pow && !click && actions[i] == 'click')
		{
			click = true;
		}
		else if (key && pow && click && actions[i] == 'click')
		{
			sum ++;
			click = false;
		}
	}	
	return (sum);
}

actions = ["power", "keystrokes", "click", "click", "power", "click", "click"]
console.log(getResult(actions));