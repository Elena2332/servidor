/*  
    {id: 1, nombre: 'Harry', email: 'harry@bluuweb.cl', estado: 'alabama', edad: 45, …}
    {id: 2, nombre: 'Debra', email: 'deb@bluuweb.cl', estado: false, edad: 67, …}
    {id: 3, nombre: 'Dexter', email: 'dex@bluuweb.cl', estado: true, edad: 19, …}
    {id: 4, nombre: 'Rita', email: 'rita@bluuweb.cl', estado: true, edad: 81, …}
*/

window.onload
{
    fetch('tabla.json')
        .then(res=> res.json())
        .then(data=>{
            for(key in data)
            {
                console.log(data[key])
            }
        })
}