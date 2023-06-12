<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';

let responseData = ref(null);

onMounted(() => {
  axios.get("http://localhost:8002/getMovies.php")
    .then((res) => {
      responseData.value = res.data;
      console.log(responseData.value)
    })
    .catch((error) => {
      console.log(error);
    });
})

// console.log(responseData.value)

const formData = ref({
  name: '',
  author: ''
});

function submitForm(event) {
  event.preventDefault();

  console.log(formData.value);

  axios.post("http://localhost:8002/addMovies.php", formData.value, {
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    }
  })
    .then((response) => {
      console.log(response);
    })
    .catch((error) => {
      console.log(error);
    })
}


function deleteMovies (id) {
  console.log(id)
  axios.delete(`http://localhost:8002/deleteMovies.php?id=${id}`)
  .then(response => console.log(response))
  .catch(error => console.log(error));
}

const filterMovie = ref("");

function selectFilter () {
  console.log(filterMovie.value);

  axios.get(`http://localhost:8002/selectMovies.php?selectFor=${filterMovie.value}`)
  .then(response => responseData.value = response.data)
  .catch(error => console.log(error))
}

</script>

<template>
  
  <section class="formsQueries">
    
    <form class="formMain" @submit="submitForm">
      <h1>Adicionar Filme</h1>
      <div class="form">
        <div class="inputs">
          <input class="inputOne" type="text" v-model="formData.name" placeholder="Nome do Filme">
          <input type="text" v-model="formData.author" placeholder="Autoria do Filme">
        </div>
        <button type="submit">Adicionar</button>
      </div>
    </form>

    <div class="selects">
      <h1>Procurar Filmes</h1>
      <input type="text" v-model="filterMovie" placeholder="Procure por aqui...">
      <button type="button" @click="selectFilter">Vai</button>
    </div>

  </section>


  <div class="tableDad">
    <table class="table">
      <tr>
        <th>Id</th>
        <th>Nome do filme</th>
        <th>Autoria</th>
        <th>Deletar filme</th>
      </tr>
      <tr v-for="movie in responseData">
        <td>{{ movie.id }}</td>
        <td>{{ movie.name }}</td>
        <td>{{ movie.author }}</td>
        <td><button type="button" class="deleteButton" @click="deleteMovies(movie.id)">Deletar</button></td>
      </tr>
    </table>
  </div>
</template>

<style>
.tableDad {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem;
  background: rgba(37, 38, 39, 0);
  box-shadow: 8px rgba(255, 255, 255, 0.37);
  backdrop-filter: blur(19.5px);
  -webkit-backdrop-filter: blur(19.5px);
  border-radius: 10px;
  border: 1px solid rgba(255, 255, 255, 0.18);
}

.table {
  border-collapse: collapse;
  text-align: start;
}

.table th,
.table td {
  padding: 0.4rem 2rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.18);
}

.table th {
  color: #ffffff;
  text-align: start;
}

.table tr:hover {
  background-color: #8a8a8a42;
}

.deleteButton {
  width: 100%;
  height: 60%;
  padding: 0.2rem;

  border: none;
  border-radius: 4px;

  background-color: #ffffff;
  color: #252627;
  font-weight: 600;

  cursor: pointer;
  transition: ease 0.2s;
}

.deleteButton:hover {
  border-radius: 4px;
  background-color: #ffffffde;
}

.formsQueries {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.form {
  display: flex;
}

.inputs {
  display: flex;
  flex-direction: column;
}

.inputs input {
  border: 1px solid #cccccc;
  padding: 0.4rem;
}

.inputs input:focus {
  outline: none;
  font-weight: 600;
}

.inputOne {
  border-radius: 6px 0px 0px 0px;
}

.form button {
  border: 1px solid #cccccc;
  background-color: #ffffff;
  cursor: pointer;
  color: #252627;
  font-weight: bold;
  border-radius: 0px 6px 6px 0px;
}

.form button:hover {
  background-color: #ffffffec;
}


.selects {
  display: flex;
  flex-direction: column;
}

.selects input {
  padding: 0.4rem;
  border: 1px solid #cccccc;
  border-radius: 6px 6px 0px 0px;
}

.selects input:focus {
  outline: none;
  font-weight: 600;
}

.selects button {
  padding: 0.4rem;
  border: 1px solid #cccccc;
  background-color: #ffffff;
  cursor: pointer;
  color: #252627;
  font-weight: bold;
  border-radius: 0px 0px 0px 6px;
}

.selects button:hover {
  background-color: #ffffffec;
}

h1 {
  text-align: start;
}

</style>