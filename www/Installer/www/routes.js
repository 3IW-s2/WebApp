import * as views from "./views/Views.js";

export default {
  "/": views.index,
  "/db-setup": views.setupDatabase,
  "/db-confirmation": views.setupDatabaseConfirmation,
  "/app-setup": views.setupWebsite,
  "/app-confirmation": views.setupWebsiteConfirmation,
  "/404": views.notFound
};
