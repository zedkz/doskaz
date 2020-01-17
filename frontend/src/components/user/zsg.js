let arr1 = [1, [1,2, [3,4]], [2,4]];
// let arr2 = []

// arr1.forEach(e => {
//   if (typeof e == Array) {
//     arr1 = e
//   }
//   arr2.push(e)
// });


function iter(param) {
  let arr2 = []
  param.forEach(e => {
    if (typeof e == Array) {
      param = e
    }
    arr2.push(e)
  });
  console.log(arr2)
}

iter(arr1)