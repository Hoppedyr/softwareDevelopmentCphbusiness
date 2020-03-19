package main

import "fmt"

func main() {

	// Creating a binary search tree
	test := NewBst()

	// Inserting some data
	test.Insert(4)
	test.Insert(1)
	test.Insert(22)
	test.Insert(699)
	test.Insert(88)

	fmt.Printf("tree size => %v", test.Size())
	fmt.Println()

	showInOrder(test.root)
	fmt.Println()

	fmt.Printf("does the value 4 Existet => %v", test.Exists(4))
	fmt.Println()

	test.Delete(4)

	fmt.Printf("does the value 4 existet after delete => %v", test.Exists(4))
	fmt.Println()

	fmt.Printf("does the value 1 Existet => %v", test.Exists(1))
	fmt.Println()
}
