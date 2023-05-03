<template>
    <div class="container d-flex justify-content-center mt-5 bg-white w-50">
        <h1>Create tasks</h1>
        <form method="POST" v-on:submit.prevent="saveTask">
            <div>
                <input type="text" v-model="task" placeholder="New Task" name="todo" />
                <button type="submit">Save</button>
            </div>
        </form>
    </div>
</template>

<script>


export default {
    data() {
        return {
            task: "",
            // url: process.env.MIX_APP_URL,
        };
    },
    created() {
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            this.csrfToken = token.content;
        }
    },
    methods: {
        // Inserta en la base de datos una tarea
        saveTask() {

            const apiUrl = window.location.origin + '/proyectofinal/public/';


            fetch(apiUrl + 'tasks', {
            // fetch(this.url + 'tasks', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken,
                },
                body: JSON.stringify({
                    todo: this.task
                })
            })
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.error(error);
                });

            this.task = "";
            this.$router.push('/');
        }
    },
};
</script>
