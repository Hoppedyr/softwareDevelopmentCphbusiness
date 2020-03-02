package main

import (
	sort "GO/src/sorting"
	"bufio"
	"fmt"
	"log"
	"os"
	"regexp"
	"strings"
	"sync"
	"time"
)

var wg = sync.WaitGroup{}

func main() {
	text := getFilteredShakespearText("shakespeare-complete-works.txt")

	wg.Add(5)
	go heapSort(text)
	go mergeSort(text)
	go quickSort(text)
	go selectionSort(text)
	go insertionSort(text)
	wg.Wait()

}

func heapSort(text string) {
	array := removeDuplicates(strings.Split(text, " "))
	stime := time.Now()
	array = sort.HeapSort(array)
	etime := time.Since(stime)
	fmt.Println()
	fmt.Printf("HeapSort ended %s", etime)
	wg.Done()
}
func mergeSort(text string) {
	array := removeDuplicates(strings.Split(text, " "))
	stime := time.Now()
	array = sort.MergeSort(array)
	etime := time.Since(stime)
	fmt.Println()
	fmt.Printf("Mergesort ended %s", etime)
	wg.Done()

}
func quickSort(text string) {
	array := removeDuplicates(strings.Split(text, " "))
	stime := time.Now()
	array = sort.QuickSort(array)
	etime := time.Since(stime)
	fmt.Println()
	fmt.Printf("quicksort ended %s", etime)
	wg.Done()

}
func selectionSort(text string) {
	array := removeDuplicates(strings.Split(text, " "))
	stime := time.Now()
	array = sort.SelectionSort(array)
	etime := time.Since(stime)
	fmt.Println()
	fmt.Printf("selectionSort ended %s", etime)
	wg.Done()

}
func insertionSort(text string) {
	array := removeDuplicates(strings.Split(text, " "))
	stime := time.Now()
	array = sort.InsertionSort(array)
	etime := time.Since(stime)
	fmt.Println()
	fmt.Printf("InsertionSort ended %s", etime)
	wg.Done()

}

func getFilteredShakespearText(filename string) string {

	file, err := os.Open(filename)
	if err != nil {
		log.Fatal(err)
	}
	defer file.Close() // Execute after eveything is finished

	scanner := bufio.NewScanner(file)
	if err := scanner.Err(); err != nil {
		log.Fatalln(err)
	}

	text := ""
	for scanner.Scan() {
		text += scanner.Text() + " "
	}
	t := text
	t = regexp.MustCompile(`[0-9]`).ReplaceAllString(t, " ")
	t = regexp.MustCompile(`http(s|):\/\/www\.`).ReplaceAllString(t, " ")
	t = regexp.MustCompile(`www`).ReplaceAllString(t, " ")
	t = regexp.MustCompile(`[,\.*\/()$;\\:\@\?#\\'\-]`).ReplaceAllString(t, " ")
	t = regexp.MustCompile(`[\s]{2,}`).ReplaceAllString(t, " ")
	t = regexp.MustCompile(`\s[A-z]\s`).ReplaceAllString(t, " ")

	return strings.ToLower(t)
}

func removeDuplicates(elements []string) []string {
	encountered := map[string]bool{}
	result := []string{}
	for v := range elements {
		if encountered[elements[v]] == true {
		} else {
			encountered[elements[v]] = true
			result = append(result, elements[v])
		}
	}
	return result
}
