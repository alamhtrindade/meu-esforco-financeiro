<template>
  <div>
    <nav-bar />
    <div class="m-3">
      <h3 class="text-center" style="margin-top: 2rem;"> Lista de Tarefas </h3>
      <div>
        <div class="start">
          <b-button 
            pill 
            variant="primary" 
            class="mt-2 mb-2"
            @click="openModal"
          >
            Nova Tarefa
          </b-button> 
        </div>
        <form-new-task
          @taskCreated="closeModal"
          ref="createTaskModal"
        />
        <form-update-task
          ref="updateTaskModal" 
          :taskData="selectedTask" 
          @taskUpdated="closeModalUpdate"
        />
      </div>

      <b-table
        id="tableTasks"
        responsive
        :busy.sync="tabela.tabelaOcupada"
        :fields="tabela.fields"
        :items="tabela.items"
      >
        <template #cell(id)="row">
          <strong>
            {{row.value}}
          </strong>
        </template>
        <template #cell(name)="row">
          <strong 
            :class="{'task-completed': row.item.status === 2}"
          >
            {{ row.value }}
          </strong>
        </template>
        <template #cell(priority)="row">
          <strong 
            :class="getClassForPriority(row.item.priority, row.item.status)"
          >
            {{ verifyPriority(row.value) }}
          </strong>
        </template>
        <template #cell(status)="row">
        <strong 
            class="label-satus" :class="getClassForStatus(row.value)"
          > 
            {{ verifyStatus(row.value) }}
          </strong>
        </template>
        <template #cell(endDate)="row">
          <strong> {{ invertDate(row.value) }} </strong>
        </template>
        <template #cell(acoes)="row">
          <div>
            {{row.value}}
            <b-button 
              v-if="row.item.status === 1" 
              variant="success" 
              size="sm" 
              class="margin-button-custom" 
              @click="markDone(row.item)"
            >
              Completar
            </b-button>
            <b-button 
              v-else 
              variant="warning" 
              size="sm" 
              class="margin-button-custom" 
              @click="markDone(row.item)"
            >
              Pendente
            </b-button>
            <b-button variant="primary" size="sm" class="margin-button-custom" @click="openModalUpdate(row.item)">Editar</b-button> 
            <b-button variant="danger" size="sm" @click="deleteTask(row.item)">Excluir</b-button>
          </div>
        </template>
      </b-table>
    </div>
  </div>
</template>

<script>
import FormNewTask from '@/views/components/formNewTask/FormNewTask.vue'
import FormUpdateTask from '@/views/components/formUpdateTask/FormUpdateTask.vue'
import NavBar from '@/views/components/navBar/NavBar.vue'
import { STATUS } from '@/custom-enums/status-enum.js'
import { PRIORITY } from '@/custom-enums/priority-enum.js'
export default {
  name: 'WelcomePage',
  components: {
    FormNewTask,
    FormUpdateTask,
    NavBar
  },

  data() {
    return {
      selectedTask: null,
      tabela: {
        semDados: false,
        erroTabela: false,
        tabelaOcupada: false,
        fields: [
          { key: 'id', label: '#', class: 'width-custom-column' },
          { key: 'name', label: 'Título', sortable: false },
          { key: 'priority', label: 'Prioridade', sortable: false },
          { key: 'status', label: 'Status' },
          { key: 'endDate', label: 'Vencimento' },
          { key: 'acoes', label: 'ações', class: 'width-custom-column' },
        ],
        items: [],
      },
    };
  },

  async mounted(){
    await this.loadTasks();
  },

  methods: {
    openModal() {
      this.$refs.createTaskModal.openModal();
    },
    closeModal(){
      this.$refs.createTaskModal.closeModal();
      this.loadTasks();
    },
    openModalUpdate(task) {
      this.selectedTask = task;
      this.$refs.updateTaskModal.openModal();
    },
    closeModalUpdate(){
      this.loadTasks();
      this.$refs.updateTaskModal.closeModal();
    },
    verifyStatus(status){
      if(status === STATUS.PENDING){
        return 'Pendente';
      }else{
        return 'Completo';
      }
    },
    verifyPriority(priority){
      switch (priority) {
        case PRIORITY.NO_PRIORITY:
          return 'Sem Prioridade';
        
        case PRIORITY.LOW:
          return 'Baixa';

        case PRIORITY.MEDIUM:
          return 'Média';

        case PRIORITY.HIGH:
          return 'Alta';
        
        case PRIORITY.CRITICAL:
          return 'Crítica';

        default:
          return 'Não definida';
      }
    },
    invertDate(data) {
      const partes = data.split('/');
      const novaData = `${partes[2]}/${partes[1]}/${partes[0]}`;
    
      return novaData;
    },
    async loadTasks() {
      try {
        this.tabela.tabelaOcupada = true;
        const response = await this.$http.get(this.$api.task.getAll);

        if (response.status === 200 && Array.isArray(response.data)) {
          const tasks = response.data.map(task => ({
            id: task.id_task,
            name: task.name,
            priority: task.priority_id,
            description: task.description,
            status: task.status_id,
            startDate: task.start_date.replace(/-/g, '/'),
            endDate: task.end_date.replace(/-/g, '/'),
            startTime: task.start_time,
            endTime: task.end_time,
          }));

          this.tabela.items = tasks;
          this.tabela.semDados = tasks.length === 0;
        }
      } catch (error) {
        this.tabela.erroTabela = true;
      } finally {
        this.tabela.tabelaOcupada = false;
      }
    },
    getClassForStatus(status) {
      if (status === STATUS.PENDING) {
        return 'danger';
      } else {
        return 'success';
      }
    },
    getClassForPriority(priority){
      switch (priority) {
        case PRIORITY.NO_PRIORITY:
          return 'text-color-no-priority';
        
        case PRIORITY.LOW:
          return 'text-color-priority-low';

        case PRIORITY.MEDIUM:
          return 'text-color-priority-medium';

        case PRIORITY.HIGH:
          return 'text-color-priority-high';
        
        case PRIORITY.CRITICAL:
          return 'text-color-priority-critical';

        default:
          return '';
      }
    },
    async markDone(task){
      task.status = task.status === STATUS.PENDING ? STATUS.COMPLETED : STATUS.PENDING;
      try {
        const res = await this.$http.put(this.$api.task.update, task);
        if (res.status === 200) {
          this.loadTasks();
        } else {
          alert(res.data.error);
        }
        
      } catch (error) {
        alert(error.response.data.error);
      }
    },
    async deleteTask(task){
      try {
        const res = await this.$http.delete(this.$api.task.delete(task.id));
        if (res.status === 200) {
          this.loadTasks();
        } else {
          alert(res.data.error);
        }
        
      } catch (error) {
        alert(error.response.data.error);
      }
    },
  },
};
</script>

<style>
  .label-satus{
    color: white;
    border-radius: 20px;
    padding: 8px 14px;
    font-weight: bold;
    display: inline-block;
  }
  .danger{
    background-color: #c91e5a;
  }
  .success{
    background-color: green;
  }
  .margin-button-custom{
    margin-right: 10px;
  }
  .task-completed{
    text-decoration: line-through;
  }
  .text-color-no-priority{
    color: #24c0eb;
  }
  .text-color-priority-low{
    color: #c0de5d;
  }
  .text-color-priority-medium{
    color: #e8b666;
  }
  .text-color-priority-high{
    color: #ff9a52;
  }
  .text-color-priority-critical{
    color: #c91e5a;
  }
</style>