function getResult(nums) {
    var res = [];
	nums = nums.sort(function(a, b) {return a - b;});
	res = nums.slice(0, nums.length / 2);
	return res;
}

nums = [1, 3, 5, 6, 7];

console.log(getResult(nums));