package main

import (
	"fmt"
	"testing"
)

var tests = []struct {
	input  int
	output bool
}{
	{6, true},
	{16, false},
	{3, true},
	{20, false},
	{345, false},
	{40, true},
}

type Node struct {
	key   int
	Left  *Node
	Right *Node
}

func (n *Node) Seach(key int) bool {
	if n == nil {
		return false
	}
	if n.key < key {
		return n.Right.Seach(key)
	} else if n.key > key {
		return n.Left.Seach(key)
	}
	return true
}

func (n *Node) Insert(key int) {
	if n.key < key {
		if n.Right == nil {
			n.Right = &Node{key: key}
		} else {
			n.Right.Insert(key)
		}
	} else if n.key > key {
		if n.Left == nil {
			n.Left = &Node{key: key}
		} else {
			n.Left.Insert(key)
		}
	}
}

func (n *Node) Delete(key int) *Node {
	if n.key < key {
		n.Right = n.Right.Delete(key)
	} else if n.key > key {
		n.Left = n.Left.Delete(key)
	} else {
		if n.Left == nil {
			return n.Right
		} else if n.Right == nil {
			return n.Left
		}
		min := n.Right.Min()
		n.key = min
		n.Right = n.Right.Delete(min)
	}
	return n
}

func (n *Node) Min() int {
	if n.Left == nil {
		return n.key
	}
	return n.Left.Min()
}

func (n *Node) Max() int {
	if n.Right == nil {
		return n.key
	}
	return n.Right.Max()
}

func TestSeach(t *testing.T) {
	tree := &Node{
		key:   6,
		Left:  &Node{key: 3},
		Right: &Node{key: 40},
	}
	for i, test := range tests {
		res := tree.Seach(test.input)
		if res != test.output {
			t.Errorf("%d: got %v, exected %v", i, res, test.output)
		}
	}
}

func showInOrder(n *Node) {
	if n != nil {
		showInOrder(n.Left)
		fmt.Println(n.key)
		showInOrder(n.Right)
	}
}

func main() {

}
