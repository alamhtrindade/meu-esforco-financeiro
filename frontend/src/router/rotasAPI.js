export default {
  index: 'todas-as-tarefas-do-dia',
  statusApi: '/status',
  task: {
    create: '/task/create',
    read:   '/task/read/{idTask}',
    update: '/task/update',
    delete: (idTask) => `/task/delete/${idTask}`,
    getAll: '/task/read-all',
  },
  status: {
    create: '/status/create',
    read:   '/status/read/{idTask}',
    update: '/status/update',
    delete: '/status/delete/{idTask}'
  },
  category: {
    create: '/category/create',
    read:   '/category/read/{idCategory}',
    update: '/category/update',
    delete: '/category/delete/{idCategory}'
  }
}
