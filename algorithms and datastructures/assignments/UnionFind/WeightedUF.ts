function WeightedUnionFind(N:number) {
    var id: number[] = [];
    var size: number[] = []; 
    var treeCount: number;

    for (var i = 0; i < N; i++) {
        id[i] = i; 
        size[i] = 1; 
    }
        treeCount = N;
    function findRoot (currentEl:number) {
        while (currentEl != id[currentEl]) {
            id[currentEl] = id[id[currentEl]]
            currentEl = id[currentEl];
        }
        return currentEl;
    }
    function connected (elementA:number, elementB:number) {
        return findRoot(elementA) === findRoot(elementB);
    }
    function union (elementA:number, elementB:number) {
        var rootA = findRoot(elementA);
        var rootB = findRoot(elementB);
        if (rootA === rootB) { return; }
        if (size[rootA] < size[rootB]) {
            id[rootA] = rootB; size[rootB] += size[rootA];
        } else {
            id[rootB] = rootA; size[rootA] += size[rootB];
        }
        treeCount--;
    }
}


