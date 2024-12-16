<template>
  <div class="mt-2 mb-5">
    <b-modal 
      id="modalFormCreateTask"
      size="lg"
      title="Criar Tarefa"
      :hide-footer="true"
      :no-close-button="true"
      :hide-header="true"
      ref="updateTaskModal"
    >
      <b-form @submit="onSubmit" @reset="onReset" v-if="show">
        <h4 class="mt-2 mb-4"> Editar Tarefa </h4>
        <b-row>
          <b-col cols="8"> 
            <b-form-group id="input-group-1" label="Nome Tarefa:" label-for="input-1">
              <b-form-input
                id="input-1"
                v-model="task.name"
                required
              />
            </b-form-group>
            <b-form-group id="input-group-2" label="Descrição:" label-for="input-2">
              <b-form-input
                id="input-2"
                v-model="task.description"
                required
              />
            </b-form-group>
          </b-col>
          <b-col cols="4">
            <b-form-group id="input-group-3" label="Prioridade:" label-for="input-3" class="mt-1">
              <b-form-select
                id="input-3"
                v-model="task.priority"
                :options="priorities"
                required
              />
            </b-form-group>
          </b-col>
        </b-row>
        <div class="mt-3 mb-1">
          <strong > Datas: </strong>
        </div>
        <b-row>
          <b-col cols="6">
            <div>
              <label for="example-datepicker" class="mb-1">Data de Início</label>
              <b-row>
                <b-col cols="5">
                  <b-form-datepicker id="example-datepicker" placeholder="Início"  v-model="task.startDate"></b-form-datepicker>
                </b-col>
                <b-col cols="7">
                  <b-time
                      id="ex-disabled-readonly"
                      v-model="task.startTime"
                    ></b-time>
                </b-col>
              </b-row>
            </div>
          </b-col>
          <b-col cols="6">
            <div>
              <label for="example-datepicker2" class="mb-1">Data Final</label>
              <b-row>
                <b-col cols="5">
                  <b-form-datepicker id="example-datepicker2" placeholder="Fim"  v-model="task.endDate"></b-form-datepicker>
                </b-col>
                <b-col cols="7">
                  <b-time
                      id="ex-disabled-readonly2"
                      v-model="task.endTime"
                    ></b-time>
                </b-col>
              </b-row>
            </div>
          </b-col>
        </b-row>
        <div class="separator-line"> </div>
        <b-row>
          <div class="mt-2 mb-3 text-end">
            <b-button type="submit" variant="primary" class="m-1">Salvar</b-button>
            <b-button type="reset" variant="danger">Cancelar</b-button>
          </div>
        </b-row>
      </b-form>
    </b-modal>
  </div>
</template>

<script>
import { STATUS } from '@/custom-enums/status-enum.js'
export default {
  name: "FormUpdateTask",
  props: {
    taskData: {
      type: Object,
      default: () => ({
        id:null,
        name: "",
        description: "",
        priority: null,
        startDate: "",
        endDate: "",
        startTime: "",
        endTime: ""
      })
    },
  },

  data() {
    return {
      task: {
        id:null,
        name: "",
        description: "",
        priority: null,
        startDate: "",
        endDate: "",
        startTime: "",
        endTime: ""
      },
      priorities: [
        { value: 1, text: 'Sem Prioridade' },
        { value: 2, text: 'Baixa' },
        { value: 3, text: 'Média' },
        { value: 4, text: 'Alta' },
        { value: 5, text: 'Crítica' }
      ],
      categories: [
        { value: 1, text: 'Sem Categoria' },
        { value: 2, text: 'Pessoais' },
        { value: 3, text: 'Familiar' },
        { value: 4, text: 'Trabalho' }
      ],
      show: true
    };
  },

  methods: {
    openModal() {
      this.loadTaskInForm();
      this.$refs.updateTaskModal.show();
    },
    closeModal() {
      this.$refs.updateTaskModal.hide();
    },
    onSubmit(event) {
      event.preventDefault();
      this.updateTask();
    },
    onReset() {
      this.taskLocal = { ...this.task };
      this.closeModal();
    },
    loadTaskInForm(){
      this.$nextTick(() => {
        if(this.taskData){
          this.task.id = this.taskData.id;
          this.task.name = this.taskData.name;
          this.task.description = this.taskData.description ;
          this.task.priority = this.taskData.priority;
          this.task.status = this.taskData.status;
          this.task.startDate =this.taskData.startDate.replace(/\//g, '-');
          this.task.endDate = this.taskData.endDate.replace(/\//g, '-');
          this.task.startTime = this.taskData.startTime;
          this.task.endTime = this.taskData.endTime;
        }
      });
    },
    async updateTask() {
      try {
        const normalized = this.normalizeDates();
        if (normalized) {
          this.task.status = STATUS.PENDING;
          const res = await this.$http.put(this.$api.task.update, this.task);

          if (res.status === 200) {
            alert("Atualizado com sucesso!");
            this.$emit("taskUpdated");
            this.closeModal();
          } else {
            alert(res.data.error);
          }
        }
      } catch (error) {
        alert(error.response?.data?.error || "Erro ao atualizar a tarefa");
      }
    },
    normalizeDates() {
      this.task.startDate = this.task.startDate.replace(/-/g, "/");
      this.task.endDate = this.task.endDate.replace(/-/g, "/");

      return true;
    }
  }
};
</script>

<style scoped>
.separator-line {
  height: 1px;
  background-color: #dcdcdc;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin-top: 30px;
}
</style>