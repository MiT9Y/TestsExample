Дана строка s, она содержит подстроки c одинаковыми символами, подстроки разделены пробелом.

Вы можете поэтапно заменять пробелы в строке на любые символы.

Если между разными последовательностями не окажется пробела, то подстрока с бóльшим количеством символов заменит остальные подстроки. Например, строка "aaabb" становится "aaaaa".

Создайте максимально крупную подстроку заданного символа. Гарантируется, что одинакового количества разных символов в результате замен у двух подстрок быть не может.

Ввод:

s - строка символов, все последовательности разделены пробелом, 1<=length(s)<=100, s[i]=space,a..z
symbol - заданный символ, length(symbol)=1
Вывод:

Integer - количество одинаковых подряд идущих заданных символов

Пример 1:

s = "aaa bbb"
symbol = "a"
getResult(s, symbol) = 7 // пробел заменяем на "a", тогда получаем "aaaabbb", которая по правилу заменяется на "aaaaaaa" - всего 7 символов "a"
Пример 2:

s = "bbbb cc aa"
symbol = "b"
getResult(s, symbol) = 10 // первый пробел заменяем на "b", тогда получаем "bbbbbcc aa", которая по правилу заменяется на "bbbbbbb aa", далее второй пробел заменяем на "b", получаем "bbbbbbbbaa" -> "bbbbbbbbbb", всего 10 символов "b"


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