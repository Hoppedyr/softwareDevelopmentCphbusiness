def selectionSort(array):
    for i in range(len(array)):
        minPosition = i
        for j in range(i+1, len(array)):
            if array[minPosition] > array[j]:
                minPosition = j
        temp = array[i]
        array[i] = array[minPosition]
        array[minPosition] = temp
    return array
