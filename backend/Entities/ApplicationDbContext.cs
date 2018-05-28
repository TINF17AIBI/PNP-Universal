using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using PnP_Universal;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Metadata;
namespace PnP_Universal.Entities
{
    public class ApplicationDbContext : DbContext
    {
        protected override void OnConfiguring(DbContextOptionsBuilder optionsBuilder)
        {
            optionsBuilder.UseMySql(GetConnectionString());
        }

        private static string GetConnectionString()
        {
            const string databaseName = "besa_pnp";
            const string databaseUser = "besa";
            const string databasePass = "0GdR-6p_yl69x8NOnqrs";

            return $"Server=localhost;" +
                   $"database={databaseName};" +
                   $"uid={databaseUser};" +
                   $"pwd={databasePass};" +
                   $"pooling=true;";
        }
    }
}
