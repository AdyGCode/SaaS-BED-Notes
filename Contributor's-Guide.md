# Contributor's Guide

Welcome to our project! We appreciate your interest in contributing. Below is a comprehensive guide to help you navigate the contribution process smoothly.

## 1. Fork the Main Repository to Your Personal Account: 
- If you have already forked the repository, you can skip this step. Forking creates a personal copy where you can make changes without affecting the original codebase.

## 2. Keep Your Fork Synchronised with the Main Repository:
- Regularly sync your forked with the main repository to avoid conflicts. This ensures that your pull request is based on the latest code.

## 3. Clone or Pull Updates to Your Local Machine:
- Clone your fork onto your local machine to work on the project.
-    If you don't have a local copy:

```bash
git clone https://github.com/AdyGCode/SaaS-BED-Notes.git
```
-   If you have a local copy, pull the latest updates:

```bash
git pull

```

## 4. Create a New Branch for Your Task:
- Create a branch for your feature or fix, naming it appropriately.

```bash
git branch feature/my-feature

```
- Then switch to the new branch you created

```bash
git switch feature/my-feature

```

## 5. Write Your Code:
- Contribute by writing a clean, efficient, and well-documented code.
- If implementing a new feature, create unit test for your functions.

## 6. Commit Your Work Locally with Descriptive Messages:
- Commit changes with meaningful messages summarising your work. Reference the related issue in your commit messages.
- First stage all your changed files for commit

```bash
git add .
```

-Then commit staged files to your local branch

```bash
git commit -m "feature: implemented my new feature. solves #123"
```

## 7. Push your Changes to Your Fork:
- Push your changes to your fork on GitHub for review.

```bash
git push -u origin feature/my-feature

```
## 8. Create a Pull Request (PR) to the Main Repository:
- Submit a pull request to the main repository. This is your formal contribution request.

## 9. Await Review and Address Feedback:
- Project maintainers will review your PR. Please be patient and address any requested changes promptly.

## 10. Testing and Clean-Up:
- After PR approval, test changes in the main repository.
- Clean up branches that are merged and no longer needed.

```bash
git branch -d feature/my-feature

```

By adhering to these contribution guidelines, you contribute to a seamless process for everyone involved in the project! Thank you for your valuable input.