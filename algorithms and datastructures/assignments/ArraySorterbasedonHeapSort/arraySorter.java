import java.util.Comparator;

public class ArraySorter<T extends Comparable<T>> {

    private T[] array;
    private boolean sortedAscending = true;

    public ArraySorter(T[] array) {
        this.array = array;
    }

    public void enqueue(T item) {
        resize(1);
        this.array[array.length - 1] = item;
        if (sortedAscending)
            sortAscending();
        else 
            sortDescending();
    }

    public T dequeue() {
        T item = this.array[0];
        this.array[0] = null;
        resize(-1);
        if (sortedAscending)
            sortAscending();
        else 
            sortDescending();
        return item;
    }

    public void sortAscending() {
        sort((a, b) -> a.compareTo(b));
        sortedAscending = true;
    }

    public void sortDescending() {
        sort((a, b) -> b.compareTo(a));
        sortedAscending = false;
    }

    public void sort(Comparator<T> comparator) {
        int n = this.array.length;
        for (int i = n / 2 - 1; i >= 0; i--) {
            heapify(this.array, n, i, comparator);
        }
        for (int i = n - 1; i >= 0; i--) {
            T temp = this.array[0];
            this.array[0] = this.array[i];
            this.array[i] = temp;
            heapify(this.array, i, 0, comparator);
        }
    }

    public void resize(int direction) {
        T[] newArray = (T[]) new Comparable[this.array.length + direction];
        
        int iterator = direction < 0 ? 1 : 0;
        
        for (int i = iterator; i < this.array.length; i++) {
            if (this.array[i] != null) {
                newArray[i - iterator] = this.array[i];
            }
        }
        this.array = newArray;
    }

    public String toString() {
        String s = "";
        for (T item : array) {
            s += item.toString() + "\n";
        }
        return s;
    }

    private void heapify(T[] arr, int n, int i, Comparator comparator) {
        int largest = i; 
        int l = 2 * i + 1; 
        int r = 2 * i + 2; 
        if (l < n && comparator.compare(arr[l], arr[largest]) > 0) {
            largest = l;
        }
        if (r < n && comparator.compare(arr[r], arr[largest]) > 0) {
            largest = r;
        }
        if (largest != i) {
            T swap = arr[i];
            arr[i] = arr[largest];
            arr[largest] = swap;
            heapify(arr, n, largest, comparator);
        }
    }

    public T[] getarray() {
        return array;
    }
    
}