function get_cnt(arr, smb)
{
	var idx;

	if ((idx = arr.indexOf(smb)) != -1)
	{
		arr.splice(idx, 1);
		return (1)
	}
	return (0);
}

function chk_name(str1, str2)
{
	var res = 0;
	var str1_arr;
	var str2_arr;
	var cnt_smb_arr1;
	var cnt_smb_arr2;
	var smb;

	str1 = str1 + '';
	str2 = str2 + '';

	str1_arr = str1.toLowerCase().split('');
	str2_arr = str2.toLowerCase().split('');

	if (Math.abs(str1.length - str2.length) > 1)
		return (false);

	while (str1_arr.length > 0)
	{
		smb = str1_arr[0];
		cnt_smb_arr1 = get_cnt(str1_arr, smb);
		cnt_smb_arr2 = get_cnt(str2_arr, smb);
		res += Math.abs(cnt_smb_arr1 - cnt_smb_arr2);
		if (res > 1)
			return (false);
	}
	if (str1.length == str2.length && str2_arr.length == 1 && res == 1)
		return (true);
	res += str2_arr.length;
	if (res > 1)
		return (false);
	return (true);
}

function getResult(calendar, dateOfBirth, name, phrases) {
    var age = calendar - dateOfBirth;
    var phr_age = Number(phrases[0]);

    if (Number.isNaN(phr_age))
        return(false);
    if (phr_age != age && phr_age + 1 != age)
		return (false);
	if (!chk_name(phrases[1], name))
		return (false);
	return (true);
}

var calendar = 1984;
var date_of_birth = 1950;
var name = 'anna';
var phrases = ['34', 'anna'];
console.log(getResult(calendar, date_of_birth, name, phrases));