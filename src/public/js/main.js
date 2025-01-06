try {
  throw new Error("例外が投げられました");
} catch (error) {
  console.log(error.message);
}
