<?php

class UnionFind
{
    private $size = 0;
    private $sz = array();
    private $id = array();
    private $numComponents = 0;

    /**
     * UnionFind constructor.
     * @param int $size
     * @param array $sz
     * @param array $id
     * @param int $numComponents
     */
    public function __construct(int $size, array $sz, array $id, int $numComponents)
    {
        $this->size = $size;
        $this->sz = $sz;
        $this->id = $id;
        $this->numComponents = $numComponents;
    }

    public function unionFind($size): void
    {
        $this->$size = $numComponent = $size;
        array_push($this->sz, $size);
        array_push($this->id, $size);

        for ($i = 0; $i < $size; $i++) {
            $this->id[$i] = $i; // Link to itself (self root)
            $this->sz[$i] = $i; // Each component is originally of size one
        }
    }

    public function find($p): int
    {
        $root = $p;
        while ($root != $this->id[$root]) {
            $root = $this->id[$root];
        }
        while ($p != $root) {
            $next = $this->id[$p];
            $this->id[$p] = $root;
            $p = $next;
        }
        return $root;
    }

    public function connected($p, $q): bool
    {
        return $this->find($p) == $this->find($q);
    }

    public function componentSize($p): int
    {
        return $this->sz[$this->find($p)];
    }
    public function size():int
    {
        return $this->size;
    }
    public function unify($p, $q):void
    {
        $root1 = $this->find($p);
        $root2 = $this->find($q);

        if ($root1 == $root2)
            return;

        // Merge smaller component/set into the larger one.
        if ($this->sz[$root1] < $this->sz[$root2]) {
            $this->sz[$root2] += $this->sz[$root1];
            $this->id[$root1] = $root2;
        } else {
            $this->sz[$root1] += $this->sz[$root2];
            $this->id[$root2] =  $root1;
        }

        // Since the roots found are different we know that the
        // number of components/sets has decreased by one
        $this->numComponents--;

    }


}

;

