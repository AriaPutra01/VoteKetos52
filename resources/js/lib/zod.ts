import { z } from "zod";

// Login User
export const LoginSchema = z.object({
  username: z.string().min(2).max(50),
  password: z.string().min(2).max(50),
});
export type LoginValue = z.infer<typeof LoginSchema>;
