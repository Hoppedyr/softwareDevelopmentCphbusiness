package main

import "fmt"

// Print the tree in-order
// Traverse the left sub-tree, root, right sub-tree
func showInOrder(root *Node) {
	if root != nil {
		showInOrder(root.left)
		fmt.Println(root.value)
		showInOrder(root.right)
	}
}
