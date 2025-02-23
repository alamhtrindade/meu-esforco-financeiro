export async function createPerson( name, nif ) {
    try {
      const response = await  fetch("https://api-meu-esforco-financeiro.docker.dev/person/create", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            name,
            nif,
        }),
      });
      const data = await response.json();

      return data;
    } catch (error) {
      console.error("Erro ao salvar os dados", error);
      return error;
    }
};

export async function getAll() {
    try {
      const response = await fetch("https://api-meu-esforco-financeiro.docker.dev/person/read/");
      const data = await response.json();
      return data;
    } catch (error) {
      console.error("Erro ao buscar os clientes:", error);
      return error;
    }
};

export async function getByPersonAndMonth(idPerson, month) {
  try {
    const response = await fetch(`https://api-meu-esforco-financeiro.docker.dev/person/read/${idPerson}/${month}`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Erro ao buscar os clientes:", error);
    return error;
  }
};

export async function createIncome(data) {
  try {
    const response = await fetch("https://api-meu-esforco-financeiro.docker.dev/income/create", {
      method: "POST",
      headers: {
          "Content-Type": "application/json",
      },
      body: JSON.stringify({
          "id_person": data.idPerson,
          "value" : data.value,
          "date_income": data.date_income
      }),
    });

    if (!response.ok) {
        throw new Error("Erro ao salvar os dados");
    }

    const res = await response.json();
    return res;
  } catch (error) {
    console.error("Erro ao criar uma entrada. Tente novamente mais tarde.", error);
    return error;
  }
};

export async function createExpense(data) {
  try {
    const response = await fetch("https://api-meu-esforco-financeiro.docker.dev/expense/create", {
      method: "POST",
      headers: {
          "Content-Type": "application/json",
      },
      body: JSON.stringify({
          "id_person": data.idPerson,
          "value" : data.value,
          "date_expense": data.date_expense
      }),
    });

    if (!response.ok) {
        throw new Error("Erro ao salvar os dados");
    }

    const res = await response.json();
    return res;
  } catch (error) {
    console.error("Erro ao criar uma entrada. Tente novamente mais tarde.", error);
    return error;
  }
} 