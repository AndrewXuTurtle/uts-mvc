# Laravel API Integration Guide for Next.js

## 🚀 Overview

This guide provides comprehensive instructions for integrating your Laravel API with a Next.js application. The API provides access to academic management data including projects, lecturers (dosen), and courses (matakuliah).

## 📋 API Endpoints

### Base URL
```
http://localhost:8000/api
```

### Available Endpoints

#### 📚 Projects (Projects)
- `GET /api/project` - Get all projects
- `GET /api/project/{id}` - Get specific project
- `POST /api/project` - Create new project
- `PUT /api/project/{id}` - Update project
- `DELETE /api/project/{id}` - Delete project
- `DELETE /api/project/{id}/gallery` - Delete specific gallery image

#### 👨‍🏫 Lecturers (Dosen)
- `GET /api/dosen` - Get all lecturers
- `GET /api/dosen/{id}` - Get specific lecturer
- `POST /api/dosen` - Create new lecturer
- `PUT /api/dosen/{id}` - Update lecturer
- `DELETE /api/dosen/{id}` - Delete lecturer

#### 📖 Courses (Matakuliah)
- `GET /api/matakuliah` - Get all courses
- `GET /api/matakuliah/{id}` - Get specific course
- `POST /api/matakuliah` - Create new course
- `PUT /api/matakuliah/{id}` - Update course
- `DELETE /api/matakuliah/{id}` - Delete course

## 🔧 Setup Instructions

### 1. Laravel API Server
Ensure your Laravel server is running:
```bash
php artisan serve
```
Server will be available at: `http://localhost:8000`

### 2. Next.js Project Setup
Create a new Next.js project:
```bash
npx create-next-app@latest my-academic-app
cd my-academic-app
npm install
```

### 3. Environment Configuration
Create `.env.local` in your Next.js project:
```env
NEXT_PUBLIC_API_URL=http://localhost:8000/api
```

### 4. Next.js Image Configuration
Update `next.config.js` or `next.config.ts` to allow images from Laravel:

```javascript
// next.config.js
module.exports = {
  images: {
    remotePatterns: [
      {
        protocol: 'http',
        hostname: 'localhost',
        port: '8000',
        pathname: '/storage/**',
      },
    ],
  },
}

// OR for TypeScript (next.config.ts)
import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  images: {
    remotePatterns: [
      {
        protocol: 'http',
        hostname: 'localhost',
        port: '8000',
        pathname: '/storage/**',
      },
    ],
  },
};

export default nextConfig;
```

**Important**: Restart your Next.js development server after updating the config:
```bash
# Stop the server (Ctrl+C)
npm run dev  # Start again
```

## 📝 Next.js Implementation Examples

### API Client Setup (`lib/api.js`)

```javascript
const API_BASE_URL = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api';

class ApiClient {
  constructor() {
    this.baseURL = API_BASE_URL;
  }

  async request(endpoint, options = {}) {
    const url = `${this.baseURL}${endpoint}`;

    const config = {
      headers: {
        'Content-Type': 'application/json',
        ...options.headers,
      },
      ...options,
    };

    try {
      const response = await fetch(url, config);

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      return await response.json();
    } catch (error) {
      console.error('API request failed:', error);
      throw error;
    }
  }

  // Projects
  async getProjects() {
    return this.request('/project');
  }

  async getProject(id) {
    return this.request(`/project/${id}`);
  }

  async createProject(data) {
    return this.request('/project', {
      method: 'POST',
      body: JSON.stringify(data),
    });
  }

  async updateProject(id, data) {
    return this.request(`/project/${id}`, {
      method: 'PUT',
      body: JSON.stringify(data),
    });
  }

  async deleteProject(id) {
    return this.request(`/project/${id}`, {
      method: 'DELETE',
    });
  }

  // Lecturers
  async getLecturers() {
    return this.request('/dosen');
  }

  async getLecturer(id) {
    return this.request(`/dosen/${id}`);
  }

  // Courses
  async getCourses() {
    return this.request('/matakuliah');
  }

  async getCourse(id) {
    return this.request(`/matakuliah/${id}`);
  }
}

export const apiClient = new ApiClient();
```

### React Hook for Data Fetching (`hooks/useApi.js`)

```javascript
import { useState, useEffect } from 'react';
import { apiClient } from '../lib/api';

export function useApi(endpoint, options = {}) {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        setLoading(true);
        const result = await apiClient.request(endpoint, options);
        setData(result);
        setError(null);
      } catch (err) {
        setError(err.message);
        setData(null);
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [endpoint, JSON.stringify(options)]);

  return { data, loading, error, refetch: () => fetchData() };
}

export function useProjects() {
  return useApi('/project');
}

export function useProject(id) {
  return useApi(`/project/${id}`);
}

export function useLecturers() {
  return useApi('/dosen');
}

export function useCourses() {
  return useApi('/matakuliah');
}
```

### Project List Component (`components/ProjectList.js`)

```javascript
import { useProjects } from '../hooks/useApi';

export default function ProjectList() {
  const { data: projects, loading, error } = useProjects();

  if (loading) return <div>Loading projects...</div>;
  if (error) return <div>Error: {error}</div>;

  return (
    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      {projects?.map((project) => (
        <div key={project.project_id} className="bg-white rounded-lg shadow-md p-6">
          <h3 className="text-xl font-semibold mb-2">{project.judul_proyek}</h3>

          {project.foto_utama_url && (
            <img
              src={project.foto_utama_url}
              alt={project.judul_proyek}
              className="w-full h-48 object-cover rounded mb-4"
            />
          )}

          <div className="space-y-2 text-sm text-gray-600">
            <p><strong>Mahasiswa:</strong> {project.nama_mahasiswa}</p>
            <p><strong>NIM:</strong> {project.nim_mahasiswa}</p>
            <p><strong>Program Studi:</strong> {project.program_studi}</p>
            <p><strong>Tahun:</strong> {project.tahun_selesai}</p>
          </div>

          {project.galeri_urls && project.galeri_urls.length > 0 && (
            <div className="mt-4">
              <p className="text-sm font-medium mb-2">Galeri ({project.galeri_urls.length} gambar):</p>
              <div className="grid grid-cols-3 gap-2">
                {project.galeri_urls.slice(0, 3).map((url, index) => (
                  <img
                    key={index}
                    src={url}
                    alt={`Gallery ${index + 1}`}
                    className="w-full h-16 object-cover rounded"
                  />
                ))}
              </div>
            </div>
          )}
        </div>
      ))}
    </div>
  );
}
```

### Project Detail Page (`pages/projects/[id].js`)

```javascript
import { useRouter } from 'next/router';
import { useProject } from '../../hooks/useApi';

export default function ProjectDetail() {
  const router = useRouter();
  const { id } = router.query;
  const { data: project, loading, error } = useProject(id);

  if (loading) return <div>Loading...</div>;
  if (error) return <div>Error: {error}</div>;
  if (!project) return <div>Project not found</div>;

  return (
    <div className="max-w-4xl mx-auto p-6">
      <button
        onClick={() => router.back()}
        className="mb-6 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"
      >
        ← Back
      </button>

      <div className="bg-white rounded-lg shadow-md p-6">
        <h1 className="text-3xl font-bold mb-4">{project.judul_proyek}</h1>

        {project.foto_utama_url && (
          <img
            src={project.foto_utama_url}
            alt={project.judul_proyek}
            className="w-full max-h-96 object-cover rounded mb-6"
          />
        )}

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
          <div>
            <h2 className="text-xl font-semibold mb-3">Project Information</h2>
            <div className="space-y-2">
              <p><strong>Mahasiswa:</strong> {project.nama_mahasiswa}</p>
              <p><strong>NIM:</strong> {project.nim_mahasiswa}</p>
              <p><strong>Program Studi:</strong> {project.program_studi}</p>
              <p><strong>Dosen Pembimbing:</strong> {project.dosen_pembimbing}</p>
              <p><strong>Tahun Selesai:</strong> {project.tahun_selesai}</p>
              <p><strong>Keywords:</strong> {project.keywords}</p>
            </div>
          </div>

          <div>
            <h2 className="text-xl font-semibold mb-3">Description</h2>
            <p className="text-gray-700">{project.deskripsi_singkat}</p>
          </div>
        </div>

        {project.galeri_urls && project.galeri_urls.length > 0 && (
          <div>
            <h2 className="text-xl font-semibold mb-4">Gallery</h2>
            <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
              {project.galeri_urls.map((url, index) => (
                <div key={index} className="aspect-square">
                  <img
                    src={url}
                    alt={`Gallery image ${index + 1}`}
                    className="w-full h-full object-cover rounded-lg cursor-pointer hover:opacity-80 transition-opacity"
                    onClick={() => window.open(url, '_blank')}
                  />
                </div>
              ))}
            </div>
          </div>
        )}
      </div>
    </div>
  );
}
```

### Main Page (`pages/index.js`)

```javascript
import { useState } from 'react';
import ProjectList from '../components/ProjectList';
import { useLecturers, useCourses } from '../hooks/useApi';

export default function Home() {
  const [activeTab, setActiveTab] = useState('projects');
  const { data: lecturers, loading: lecturersLoading } = useLecturers();
  const { data: courses, loading: coursesLoading } = useCourses();

  const tabs = [
    { id: 'projects', label: 'Projects', component: ProjectList },
    { id: 'lecturers', label: 'Lecturers' },
    { id: 'courses', label: 'Courses' },
  ];

  return (
    <div className="min-h-screen bg-gray-100">
      <header className="bg-white shadow">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center py-6">
            <h1 className="text-3xl font-bold text-gray-900">Academic Management System</h1>
          </div>
        </div>
      </header>

      <nav className="bg-white shadow-sm">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex space-x-8">
            {tabs.map((tab) => (
              <button
                key={tab.id}
                onClick={() => setActiveTab(tab.id)}
                className={`py-4 px-1 border-b-2 font-medium text-sm ${
                  activeTab === tab.id
                    ? 'border-blue-500 text-blue-600'
                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                }`}
              >
                {tab.label}
              </button>
            ))}
          </div>
        </div>
      </nav>

      <main className="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div className="px-4 py-6 sm:px-0">
          {activeTab === 'projects' && <ProjectList />}

          {activeTab === 'lecturers' && (
            <div>
              <h2 className="text-2xl font-bold mb-4">Lecturers</h2>
              {lecturersLoading ? (
                <div>Loading lecturers...</div>
              ) : (
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                  {lecturers?.map((lecturer) => (
                    <div key={lecturer.dosen_id} className="bg-white rounded-lg shadow-md p-6">
                      {lecturer.foto_url && (
                        <img
                          src={lecturer.foto_url}
                          alt={lecturer.nama_dosen}
                          className="w-24 h-24 rounded-full mx-auto mb-4 object-cover"
                        />
                      )}
                      <h3 className="text-lg font-semibold text-center">{lecturer.nama_dosen}</h3>
                      <p className="text-center text-gray-600">{lecturer.nip}</p>
                    </div>
                  ))}
                </div>
              )}
            </div>
          )}

          {activeTab === 'courses' && (
            <div>
              <h2 className="text-2xl font-bold mb-4">Courses</h2>
              {coursesLoading ? (
                <div>Loading courses...</div>
              ) : (
                <div className="bg-white shadow overflow-hidden sm:rounded-md">
                  <ul className="divide-y divide-gray-200">
                    {courses?.map((course) => (
                      <li key={course.mk_id}>
                        <div className="px-4 py-4 sm:px-6">
                          <div className="flex items-center justify-between">
                            <div className="flex-1">
                              <h3 className="text-lg font-medium text-gray-900">
                                {course.kode_mk} - {course.nama_mk}
                              </h3>
                              <p className="text-sm text-gray-600">
                                {course.sks} SKS • Semester {course.semester} • {course.program_studi}
                              </p>
                            </div>
                            <div className="text-right">
                              <span className={`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${
                                course.status_wajib === 'wajib'
                                  ? 'bg-green-100 text-green-800'
                                  : 'bg-yellow-100 text-yellow-800'
                              }`}>
                                {course.status_wajib}
                              </span>
                            </div>
                          </div>
                        </div>
                      </li>
                    ))}
                  </ul>
                </div>
              )}
            </div>
          )}
        </div>
      </main>
    </div>
  );
}
```

## 🧪 Testing the API

### Using cURL

```bash
# Get all projects
curl -H "Accept: application/json" http://localhost:8000/api/project

# Get specific project
curl -H "Accept: application/json" http://localhost:8000/api/project/1

# Get all lecturers
curl -H "Accept: application/json" http://localhost:8000/api/dosen

# Get all courses
curl -H "Accept: application/json" http://localhost:8000/api/matakuliah
```

### Using Postman/Insomnia

1. **Method**: GET
2. **URL**: `http://localhost:8000/api/project`
3. **Headers**:
   - `Accept: application/json`
   - `Content-Type: application/json`

### Using Browser Developer Tools

```javascript
// In browser console
fetch('http://localhost:8000/api/project')
  .then(response => response.json())
  .then(data => console.log(data))
  .catch(error => console.error('Error:', error));
```

## 🔒 Authentication & Security

Currently, the API endpoints are **public** (no authentication required). For production use, consider implementing:

- **API Tokens**: Laravel Sanctum or Passport
- **Rate Limiting**: Throttle middleware
- **CORS Policy**: Restrict origins in production

## 📊 Data Structure

### Project Response
```json
{
  "project_id": 1,
  "judul_proyek": "Game Edukasi Matematika",
  "deskripsi_singkat": "Pengembangan game edukasi...",
  "nama_mahasiswa": "John Doe",
  "nim_mahasiswa": "123456789",
  "program_studi": "Teknik Informatika",
  "dosen_pembimbing": "Dr. Ahmad Rahman",
  "tahun_selesai": 2024,
  "path_foto_utama": "projects/1234567890_image.jpg",
  "path_foto_galeri": "projects/gal1.jpg,projects/gal2.jpg",
  "keywords": "game, edukasi, matematika",
  "foto_utama_url": "http://localhost:8000/storage/projects/1234567890_image.jpg",
  "galeri_urls": [
    "http://localhost:8000/storage/projects/gal1.jpg",
    "http://localhost:8000/storage/projects/gal2.jpg"
  ],
  "created_at": "2025-01-01T00:00:00.000000Z",
  "updated_at": "2025-01-01T00:00:00.000000Z"
}
```

### Lecturer Response
```json
{
  "dosen_id": 1,
  "nama_dosen": "Dr. Ahmad Rahman",
  "nip": "123456789",
  "foto": "dosen/1234567890_photo.jpg",
  "foto_url": "http://localhost:8000/storage/dosen/1234567890_photo.jpg",
  "created_at": "2025-01-01T00:00:00.000000Z",
  "updated_at": "2025-01-01T00:00:00.000000Z"
}
```

### Course Response
```json
{
  "mk_id": 1,
  "kode_mk": "TPL1101",
  "nama_mk": "Pengantar Teknologi Informasi",
  "sks": 2,
  "semester": 1,
  "program_studi": "Teknik Perangkat Lunak",
  "kurikulum_tahun": "2024",
  "deskripsi_singkat": "Mata kuliah ini memperkenalkan...",
  "status_wajib": "wajib",
  "created_at": "2025-01-01T00:00:00.000000Z",
  "updated_at": "2025-01-01T00:00:00.000000Z"
}
```

## 🚨 Error Handling

The API returns appropriate HTTP status codes:

- `200` - Success
- `404` - Resource not found
- `422` - Validation error
- `500` - Server error

Error response format:
```json
{
  "message": "Project not found"
}
```

## 🎯 Next Steps

1. **Start your Next.js app**: `npm run dev`
2. **Test API endpoints** using the provided examples
3. **Customize components** to match your design requirements
4. **Add error boundaries** for better user experience
5. **Implement loading states** and pagination if needed

## 📞 Support

If you encounter issues:

1. Check that Laravel server is running: `http://localhost:8000`
2. Verify API endpoints are accessible
3. Check browser console for CORS errors
4. Ensure Next.js environment variables are set correctly

Happy coding! 🎉</content>
<parameter name="filePath">/Users/andrew/development/uts-mvc/API_GUIDE.md