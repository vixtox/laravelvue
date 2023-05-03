<template>
    <div class="container d-flex justify-content-center mt-5 bg-white w-50">
        <h1>Edit task {{ id }}</h1>
        <form method="POST" v-on:submit.prevent="saveTask()">
            <div>
                <input type="text" v-model="task.todo" placeholder="New Task" name="todo" />
                <button type="submit">Save</button>
            </div>
        </form>
    </div>
</template>

<script>

export default {
    data() {
        return {
            id: this.$route.params.id,
            task: [],
            // url: process.env.MIX_APP_URL,
        };
    },
    created() {
        // const token = document.querySelector('meta[name="csrf-token"]');
        // if (token) {
        //     this.csrfToken = token.content;
        // }

        const apiUrl = window.location.origin + '/proyectofinal/public/';

        axios.get(apiUrl + 'tasks/'+this.id+'/edit')
        // axios.get(this.url + 'tasks/'+this.id+'/edit')
            .then(response => this.task = response.data)
            .catch();
    },
    methods: {
        // Edita en la base de datos una tarea
        saveTask(){
            const apiUrl = window.location.origin + '/proyectofinal/public/';

            axios.put(apiUrl + 'tasks/' + this.id, { todo: this.task.todo, completed: this.task.completed })
            // axios.put(this.url + 'tasks/' + this.id, { todo: this.task.todo, completed: this.task.completed })
                .then(response => { console.log(response) })
                .catch(error => { console.log(error.response) });
            this.task.todo = '';
            this.$router.push('/');

        }

    },
};
</script>
