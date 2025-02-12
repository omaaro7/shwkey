// Put data in boxes
let info = [{ game: [], users: [], category: [] }];

// Function to fetch game data
async function getGameData() {
  try {
    let res = await fetch(
      "../handlers/getData.php?table=games"
    );
    let data = await res.json();
    info[0].game = data;
    console.log("Game data fetched successfully:", info[0].game);
  } catch (error) {
    console.error("Error fetching game data:", error);
  }
}
// Function to fetch catigory data
async function getCategoryData() {
  try {
    let res = await fetch(
      "../handlers/getData.php?table=categories"
    );
    let data = await res.json();
    info[0].category = data;
    console.log("Game data fetched successfully:", info[0].game);
  } catch (error) {
    console.error("Error fetching game data:", error);
  }
}

// Function to fetch user data
async function getUsersData() {
  try {
    let res = await fetch(
      "../handlers/getData.php?table=users"
    );
    let data = await res.json();
    info[0].users = data;
    console.log("User data fetched successfully:", info[0].users);
  } catch (error) {
    console.error("Error fetching user data:", error);
  }
}

// Function to initialize data
async function initializeData() {
  await getUsersData();
  await getCategoryData();
  await getGameData();
  return info; // Return the populated info object
}

// Export the info object and functions
export { info, initializeData };
