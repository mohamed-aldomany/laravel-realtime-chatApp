<template>
    <div>
        <li class="list-group-item" :class="itemColor"><slot></slot><small>{{time}}</small></li>
        <small class="badge float-right" :class="badgeColor">{{user}}</small>
    </div>
</template>

<script>
    export default {

        props : [
            'color',
            'user',
            'time'
        ],
        computed : {
            itemColor(){
                return 'list-group-item-'+this.color;
            },
            badgeColor(){
                return 'badge-'+this.color;
            }
        }

    }
</script>

<style scoped>
    .list-group-item{
        margin:15px;
    }
    .badge{
        margin-right: 19px;
        position: relative;
        bottom: 20px;
    }
</style>
