package sort

func merge(a []string, b []string) []string {

	var r = make([]string, len(a)+len(b))
	var i = 0
	var j = 0

	for i < len(a) && j < len(b) {

		if a[i] <= b[j] {
			r[i+j] = a[i]
			i++
		} else {
			r[i+j] = b[j]
			j++
		}

	}

	for i < len(a) {
		r[i+j] = a[i]
		i++
	}
	for j < len(b) {
		r[i+j] = b[j]
		j++
	}

	return r

}

//MergeSort Perform mergesort on a slice of ints
func MergeSort(items []string) []string {

	if len(items) < 2 {
		return items

	}

	var middle = len(items) / 2
	var a = MergeSort(items[:middle])
	var b = MergeSort(items[middle:])
	return merge(a, b)

}
