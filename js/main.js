const buscador = document.querySelector('#buscador')
const boton = document.querySelector('#boton')
const resultado = document.querySelector('#resultado')
const perfil = document.querySelector('#perfil')
const eventos = [
  {nombre : 'Padel', aforo : 300, fecha: '3/5/2021', ubicacion : 'Madrid' },
  {nombre : 'Concierto', aforo : 300 , fecha: '3/5/2021', ubicacion : 'Madrid'},
  {nombre : 'Tenis', aforo : 300 , fecha: '3/5/2021', ubicacion : 'Madrid'},
  {nombre : 'Firma Discos', aforo : 20 , fecha: '3/5/2021', ubicacion : 'Madrid'},
  {nombre : 'Padel', aforo : 300, fecha: '3/5/2021', ubicacion : 'Madrid' },
  {nombre : 'Concierto', aforo : 300 , fecha: '3/5/2021', ubicacion : 'Madrid'},
  {nombre : 'Tenis', aforo : 300 , fecha: '3/5/2021', ubicacion : 'Madrid'},
  {nombre : 'Firma Discos', aforo : 20 , fecha: '3/5/2021', ubicacion : 'Madrid'},
  {nombre : 'Padel', aforo : 300, fecha: '3/5/2021', ubicacion : 'Madrid' },
  {nombre : 'Concierto', aforo : 300 , fecha: '3/5/2021', ubicacion : 'Madrid'},
  {nombre : 'Tenis', aforo : 300 , fecha: '3/5/2021', ubicacion : 'Madrid'},
  {nombre : 'Firma Discos', aforo : 20 , fecha: '3/5/2021', ubicacion : 'Madrid'},
  {nombre : 'Padel', aforo : 300, fecha: '3/5/2021', ubicacion : 'Madrid' },
  {nombre : 'Concierto', aforo : 300 , fecha: '3/5/2021', ubicacion : 'Pamplona'},
  {nombre : 'Tenis', aforo : 300 , fecha: '3/5/2021', ubicacion : 'Valencia'},
  {nombre : 'Firma Discos', aforo : 20 , fecha: '3/5/2021', ubicacion : 'Coruna'},
]
const usuario = {nombre : 'Sofia' , avatar : 'img/defaul.jpg'}
const filtrar = (eventos) => {
  resultado.innerHTML = '';

  const texto = buscador.value.toLowerCase();

  for(let evento of eventos){
    let nombre = evento.nombre.toLowerCase()
    let ubicacion = evento.ubicacion.toLowerCase()
    if(nombre.indexOf(texto) !== -1 || ubicacion.indexOf(texto) !== -1){  // si coincide
      resultado.innerHTML += `
      <div class="col-md-4 evs ">
        <div class="card bordeado">

            <div class="card-body">
              <h3 class="card-title">
                <a href="#" class="text-dark">${evento.nombre}</a>
              </h3>
            </div>
            <div class="card-footer">
              <div class="badge badge-danger float-right">Aforo: ${evento.aforo}</div>
                <div class="float-left">
                  <p class="text-danger"> En ${evento.ubicacion} el ${evento.fecha}</p>
                </div>
              </div>

        </div>
      </div>
      `
    }
  }
  if(resultado.innerHTML === ''){
    resultado.innerHTML += `
      <h3 class="card-title">Ningún evento encontrado</h3>
    `
  }
}
const foto= () => {
  const nombremayus = usuario.nombre.toUpperCase();
  perfil.innerHTML +=`
  <a class="links" href="">${nombremayus}</a></li>
  `
}

buscador.addEventListener('keyup', filtrar)
boton.addEventListener('click' , filtrar)

foto();
filtrar();
