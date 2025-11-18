# Contributing to Sistem Informasi TPL

Terima kasih atas minat Anda untuk berkontribusi! 🎉

## 📋 Code of Conduct

Project ini mengikuti prinsip:
- Respect dan profesional dalam komunikasi
- Constructive feedback
- Focus pada improvement, bukan kritik personal

## 🚀 How to Contribute

### Reporting Bugs 🐛

Jika menemukan bug:
1. Check [existing issues](https://github.com/AndrewXuTurtle/uts-mvc/issues)
2. Jika belum ada, buat issue baru dengan:
   - Judul yang jelas
   - Deskripsi lengkap bug
   - Steps to reproduce
   - Expected vs actual behavior
   - Screenshots (jika perlu)
   - Environment details (PHP version, Laravel version, dll)

### Suggesting Features ✨

Untuk suggest fitur baru:
1. Buka [Discussions](https://github.com/AndrewXuTurtle/uts-mvc/discussions)
2. Jelaskan:
   - Use case
   - Proposed solution
   - Alternatives considered
   - Mockups/wireframes (jika ada)

### Code Contributions 💻

#### Setup Development Environment

```bash
# Fork repo
git clone https://github.com/YOUR_USERNAME/uts-mvc.git
cd uts-mvc

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Create database & seed
php artisan migrate:fresh --seed

# Run development server
php artisan serve
npm run dev
```

#### Branch Naming Convention

```
feature/nama-fitur      # New feature
bugfix/nama-bug         # Bug fix
hotfix/critical-issue   # Critical production fix
docs/documentation-topic # Documentation update
refactor/component-name # Code refactoring
```

#### Making Changes

1. **Create Branch**
   ```bash
   git checkout -b feature/amazing-feature
   ```

2. **Write Code**
   - Follow PSR-12 coding standard
   - Add comments untuk logic yang complex
   - Update tests jika perlu

3. **Test Changes**
   ```bash
   # Run tests
   php artisan test
   
   # Check code style
   ./vendor/bin/phpcs
   
   # Fix code style
   ./vendor/bin/phpcbf
   ```

4. **Commit Changes**
   ```bash
   git add .
   git commit -m "feat: add amazing feature"
   ```

   **Commit Message Format:**
   ```
   type: subject

   body (optional)

   footer (optional)
   ```

   **Types:**
   - `feat`: New feature
   - `fix`: Bug fix
   - `docs`: Documentation
   - `style`: Formatting
   - `refactor`: Code restructure
   - `test`: Tests
   - `chore`: Maintenance

   **Examples:**
   ```
   feat: add export to PDF feature in mahasiswa module
   fix: resolve duplicate NIM validation error
   docs: update API documentation for project endpoints
   ```

5. **Push to GitHub**
   ```bash
   git push origin feature/amazing-feature
   ```

6. **Create Pull Request**
   - Go to GitHub repo
   - Click "New Pull Request"
   - Select your branch
   - Fill in PR template:
     - Description of changes
     - Related issues
     - Screenshots (jika UI changes)
     - Testing done

#### Pull Request Checklist

- [ ] Code follows PSR-12 standard
- [ ] All tests passing
- [ ] New tests added (if needed)
- [ ] Documentation updated
- [ ] No breaking changes (or clearly documented)
- [ ] Commits are clean and descriptive

## 🎨 Coding Standards

### PHP (PSR-12)

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $items = Model::with('relationship')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('items.index', compact('items'));
    }
}
```

### Blade Templates

```blade
{{-- Use short syntax --}}
@if ($condition)
    <div>Content</div>
@endif

{{-- Use components when possible --}}
<x-alert type="success">
    Success message
</x-alert>

{{-- Escape output by default --}}
{{ $variable }}

{{-- Raw output only when needed --}}
{!! $html !!}
```

### JavaScript

```javascript
// Use modern ES6+ syntax
const fetchData = async () => {
    try {
        const response = await fetch('/api/endpoint');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error:', error);
    }
};
```

## 📝 Documentation

When adding new features:
- Update relevant .md files
- Add inline comments for complex logic
- Update API documentation if API changes
- Add examples in README if needed

## 🧪 Testing

### Writing Tests

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Mahasiswa;

class MahasiswaTest extends TestCase
{
    public function test_can_view_mahasiswa_list(): void
    {
        $response = $this->get('/mahasiswa');
        
        $response->assertStatus(200);
        $response->assertViewIs('mahasiswa.index');
    }
    
    public function test_can_create_mahasiswa(): void
    {
        $data = [
            'nim' => '20250001',
            'nama' => 'Test Student',
            // ... other fields
        ];
        
        $response = $this->post('/mahasiswa', $data);
        
        $response->assertRedirect('/mahasiswa');
        $this->assertDatabaseHas('mahasiswa', ['nim' => '20250001']);
    }
}
```

### Running Tests

```bash
# All tests
php artisan test

# Specific test
php artisan test --filter=MahasiswaTest

# With coverage
php artisan test --coverage
```

## 🔍 Code Review Process

1. **PR Created** - Automated checks run
2. **Review** - Maintainer reviews code
3. **Feedback** - Changes requested (if needed)
4. **Update** - You update based on feedback
5. **Approval** - PR approved
6. **Merge** - PR merged to main

## 📮 Getting Help

- **Questions**: [Discussions](https://github.com/AndrewXuTurtle/uts-mvc/discussions)
- **Bugs**: [Issues](https://github.com/AndrewXuTurtle/uts-mvc/issues)
- **Email**: support@tpl.ac.id

## 🎉 Recognition

Contributors akan di-list di:
- README.md Contributors section
- Release notes (untuk major contributions)

Terima kasih telah berkontribusi! 🙏
