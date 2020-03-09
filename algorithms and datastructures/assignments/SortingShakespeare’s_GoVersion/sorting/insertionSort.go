package sort

func InsertionSort(arr []string) []string {
	for out := 1; out < len(arr); out++ {
		temp := arr[out]
		in := out

		for ; in > 0 && arr[in-1] >= temp; in-- {
			arr[in] = arr[in-1]
		}
		arr[in] = temp
	}
	return arr
}
