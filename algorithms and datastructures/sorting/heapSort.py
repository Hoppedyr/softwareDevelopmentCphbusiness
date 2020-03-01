def heapify(array, Length, i):
    largest = i
    l = 2 * i + 1
    r = 2 * i + 2

    if l < Length and array[i] < array[l]:
        largest = l

    if r < Length and array[largest] < array[r]:
        largest = r

    if largest != i:
        array[i], array[largest] = array[largest], array[i]
        heapify(array, Length, largest)


def heapSort(array):
    Length = len(array)

    for i in range(Length, -1, -1):
        heapify(array, Length, i)

    for i in range(Length-1, 0, -1):
        array[i], array[0] = array[0], array[i]
        heapify(array, i, 0)
