function get_tree_el(arr, res, chr)
{
	for (var i = 0; i < arr.length; i++) {
		if (arr[i].child.length > 0)
			get_tree_el(arr[i].child, res, chr);
		else if (chr === undefined)
			res.push(arr[i]);
		else if (arr[i].name == chr)
			res.push(arr[i]);
	}
	return ;
}

function get_tree_els(arr, chr) {
	var res = [];

	get_tree_el(arr, res, chr);
	return (res);
}

function set_opr_co(arr, buf)
{
	var els;


	for (var i = 0; i < buf[0].length; i++) {
		if (buf.length > 1)
		{
//			els = get_tree_els(arr, buf[0][i]);

			if (arr.length > 0)
				els = get_tree_els(arr[arr.length - 1].child, buf[0][i]);
			else
				els = [];
//				

			if (els.length == 0)
			{
				arr.push({name:buf[0][i], child:[], par: false});
				els.push(arr[arr.length - 1]);
			}
			for (var j = 0; j < els.length; j++) {
				for (var h = 0; h < buf[1].length; h++) {
					els[j].child.push({name:buf[1][h], child:[], par: els[j]});
				}
			}
		}
	}
}

function get_sindicat(last_el)
{
	var res = [];

	while (last_el.par !== false)
	{
		res.push(last_el.name);
		last_el = last_el.par;
	}
	if (res.length == 0)
		return('');
	res.sort();
	return(res.join(''));
}

function chk_add_sindicat(sindicats, obj)
{
	var last_els = [];
	var snd;

	get_tree_el(obj.child, last_els);
	for (var i = 0; i < last_els.length; i++) {
		if (obj.name == last_els[i].name)
		{
			snd = get_sindicat(last_els[i]);
			if (snd != '' && !sindicats.includes(snd))
				sindicats.push(snd);
		}
	}
}

function getResult(deal) {
    var arr = [];
	var sindicats = [];
	var i;

	for (i = 0; i < deal.length; i++) {
		set_opr_co(arr, deal[i].split("-"));
	}

	for (i = 0; i < arr.length; i++) {
		chk_add_sindicat(sindicats, arr[i]);
	}

	chk_add_sindicat(sindicats, arr[0]);

	console.log(sindicats);
	return (sindicats.length);
}

var deal = ["a-b", "b-c", "c-a", "b-c", "c-a", "a-b"];
console.log(getResult(deal));