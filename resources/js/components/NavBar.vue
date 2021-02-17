<template>
    <header class="main-header">

        <router-link to="/home" class="logo">
            <span class="logo-mini"><b>A</b>LT</span>
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </router-link>

        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Nenhuma mensagem</li>

                        </ul>
                    </li>
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Nenhuma tarefa</li>

                        </ul>
                    </li>
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa  fa-users"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 0 tasks</li>
                        </ul>
                    </li>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="" class="user-image" alt="User Image">
                            <span class="hidden-xs"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="" class="img-circle" alt="User Image">


                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat"><span
                                        class="glyphicon glyphicon-tasks"></span> Cadastro </a>
                                </div>
                                <div class="pull-right">
                                    <button @click.prevent="sendLogout" class="btn btn-danger btn-flat"><span
                                        class="glyphicon glyphicon-off"></span> Logout
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>


export default {
    name: 'va-navibar',
    data() {
        return {
            rota: this.$route.name
        }
    },
    mounted() {

    },
    methods: {
    },
    computed: {},
    created() {
    },
    components: {
    }
}

</script>
