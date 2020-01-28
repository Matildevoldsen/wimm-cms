<template>
    <div>
        <Loader :is-visible="isLoading"></Loader>
        <navigation></navigation>

        <router-view></router-view>
    </div>
</template>
<script>
export default {
    mounted() {
        this.enableInterceptor()
    },
    data: {
        isLoading: false,
        axiosInterceptor: null,
    },
    methods: {
        enableInterceptor() {
            this.axiosInterceptor = window.axios.interceptors.request.use((config) => {
                this.isLoading = true
                return config
            }, (error) => {
                this.isLoading = false  
                return Promise.reject(error)
            })
            
            window.axios.interceptors.response.use((response) => {
                this.isLoading = false    
                return response
            }, function(error) {
                this.isLoading = false
                return Promise.reject(error)
            })
        },
        
        disableInterceptor() {
            window.axios.interceptors.request.eject(this.axiosInterceptor)
        }
    }
}
</script>
<style type="text/scss">
    .m-t-50 {
        margin-top: 50px;
    }

    .m-t-100 {
        margin-top: 100px;
    }
</style>