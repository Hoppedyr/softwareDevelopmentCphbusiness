import { SuffixTrie } from './SuffixTrie';
import * as readline from 'readline';
import * as fs from 'fs';

let rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});
const st: SuffixTrie = new SuffixTrie();


function setUp(): void {
  let text: string = fs.readFileSync("./text/shakespeare-complete-works.txt").toString('utf-8');
  let textcleaned: string = text.replace(/[^\w\s]|_/g, " ").replace(/\s+/g, " ").toLowerCase();
  const textArray: Array<string> = textcleaned.split(' ');
  textArray.forEach(word => {
    st.add(word);
  })
  console.log(textArray.length)
};

function start(): void {
  rl.question('Enter a substring to find matching words: \n', (substring) => {
    console.time();
    let res: Set<string> = st.find(substring);
    console.log('\n')
    let test = Array.from(res.values())
    if (res != undefined)
      for (const item of Array.from(res.values())) {
        console.log(item);
      } else {
      console.log('could not find any matching words:' + " " + substring)
    }
    console.log(test.length)
    console.timeEnd();
    start()
  });
};



setUp()
start();

