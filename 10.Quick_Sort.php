<?php
	// 基准点划分操作
	function Partition(&$arr, $low, $high)
	{
		$point = $arr[$low];

		while ($low < $high)
		{
			while ($low<$high && $point<=$arr[$high])
				$high--;
			$arr[$low] = $arr[$high];

			while ($low<$high && $point>=$arr[$low])
				$low++;
			$arr[$high] = $arr[$low];
		}

		$arr[$low] = $point;

		return $low;
	}

	// 递归版
	function Quick_Sort_1(&$arr, $low, $high)
	{
		if ($low < $high)
		{
			$point = Partition($arr, $low, $high);
			Quick_Sort_1($arr, $low, $point-1);
			Quick_Sort_1($arr, $point+1, $high);
		}
	}

	// 跌代版
	function Quick_Sort_2(&$arr, $low, $high)
	{
		$top = 0;
		$index[$top][0] = $low;
		$index[$top++][1] = $high;

		while ($top > 0)
		{
			$top--;
			$l = $index[$top][0];
			$h = $index[$top][1];

			if ($l < $h)
			{
				$point = Partition($arr, $l, $h);
				$index[$top][0] = $l;
				$index[$top++][1] = $point-1;
				$index[$top][0] = $point+1;
				$index[$top++][1] = $h;
			}
		}
	}

	// 递归版输出
	$arr_1 = array(1,31,4,25,17,83,49,12,35,17);

	$length_1 = count($arr_1);
	Quick_Sort_1($arr_1, 0, $length_1-1);

	for ($i=0; $i<$length_1; $i++)
		echo $arr_1[$i]." ";
	echo "</br>";


	// 迭代版输出
	$arr_2 = array(1,31,4,25,17,83,49,12,35,17);

	$length_2 = count($arr_2);
	Quick_Sort_2($arr_2, 0, $length_2-1);

	for ($i=0; $i<$length_2; $i++)
		echo $arr_2[$i]." ";
?>
