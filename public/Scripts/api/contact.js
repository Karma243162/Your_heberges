const API_URL = "https://s3-4683.nuage-peda.fr/yourheberge/public/api/contacts/";

async function GetContacts(page = 1) {
  // page 1 par deafault
  try {
    //tester la response vers l API
    const response = await fetch(`${API_URL}?page=${page}`);
    console.log(response);

    if (!response.ok) {
      // verifier si la reponse est pas ok
      throw new Error("Erreur : " + response.statusText);
    }
    const data = await response.json();
    return data; //afficher la data en json
  } catch (erreur) {
    //sinon ERREUR
    console.error("Erreur lors de la recuperation :", erreur);
    throw erreur; // passer l erreur
  }
}

export { GetContacts };